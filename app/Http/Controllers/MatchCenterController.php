<?php

namespace App\Http\Controllers;

use App\Models\Ndeshja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\ValidationException;

class MatchCenterController extends Controller
{
    private function canManage(Request $request, Ndeshja $ndeshja): void
    {
        $user = $request->user();
        abort_unless($user, 401);

        if (in_array($user->role, ['admin', 'manager'], true)) {
            return;
        }

        $ndeshja->loadMissing('ekipi');

        abort_unless(
            $user->role === 'coach'
            && $user->trajner_id
            && $ndeshja->ekipi
            && (int) $ndeshja->ekipi->trajner_id
            === (int) $user->trajner_id,
            403
        );
    }

    private function accessible(Request $request)
    {
        $user = $request->user();

        abort_unless(
            in_array($user->role, ['admin', 'manager', 'coach'], true),
            403
        );

        $query = Ndeshja::query()->with('ekipi');

        if ($user->role === 'coach') {
            $query->whereHas('ekipi', function ($q) use ($user) {
                $q->where('trajner_id', $user->trajner_id ?? 0);
            });
        }

        return $query;
    }

    private function matchRecord(int $ndeshjaId)
    {
        return DB::table('match_center_matches')
            ->where('ndeshja_id', $ndeshjaId)
            ->first();
    }

    private function scores(int $matchId)
    {
        return DB::table('match_center_sets')
            ->where('match_center_match_id', $matchId)
            ->orderBy('set_number')
            ->get();
    }

    private function winner(int $home, int $away, int $number): ?string
    {
        $target = $number === 5 ? 15 : 25;

        if (max($home, $away) < $target || abs($home - $away) < 2) {
            return null;
        }

        return $home > $away ? 'home' : 'away';
    }

    private function summary($sets): array
    {
        $home = 0;
        $away = 0;

        foreach ($sets as $set) {
            if (!$set->is_completed) {
                continue;
            }

            $winner = $this->winner(
                (int) $set->home_points,
                (int) $set->away_points,
                (int) $set->set_number
            );

            if ($winner === 'home') {
                $home++;
            } elseif ($winner === 'away') {
                $away++;
            }
        }

        return ['home' => $home, 'away' => $away];
    }

    private function syncFinished(Ndeshja $ndeshja, array $summary): void
    {
        $table = $ndeshja->getTable();
        $updates = [];

        if (Schema::hasColumn($table, 'statusi')) {
            $updates['statusi'] = 'Perfunduar';
        }

        if (Schema::hasColumn($table, 'setet_tona')) {
            $updates['setet_tona'] = $summary['home'];
        }

        if (Schema::hasColumn($table, 'setet_kundershtarit')) {
            $updates['setet_kundershtarit'] = $summary['away'];
        }

        if ($updates) {
            DB::table($table)
                ->where('id', $ndeshja->id)
                ->update($updates);
        }
    }

    public function index(Request $request)
    {
        $ndeshjet = $this->accessible($request)
            ->orderByDesc('data_ndeshjes')
            ->orderByDesc('id')
            ->paginate(15);

        $records = DB::table('match_center_matches')
            ->whereIn('ndeshja_id', $ndeshjet->pluck('id'))
            ->get()
            ->keyBy('ndeshja_id');

        return view('match-center.index', compact('ndeshjet', 'records'));
    }

    public function show(Request $request, Ndeshja $ndeshja)
    {
        $this->canManage($request, $ndeshja);
        $ndeshja->load('ekipi');

        $match = $this->matchRecord($ndeshja->id);
        $sets = $match ? $this->scores($match->id) : collect();

        $summary = $this->summary($sets);

        return view('match-center.show', compact(
            'ndeshja', 'match', 'sets', 'summary'
        ));
    }

    public function manual(Request $request, Ndeshja $ndeshja)
    {
        $this->canManage($request, $ndeshja);

        $validated = $request->validate([
            'sets' => ['required', 'array', 'size:5'],
            'sets.*.home' => ['nullable', 'integer', 'min:0', 'max:999'],
            'sets.*.away' => ['nullable', 'integer', 'min:0', 'max:999'],
        ]);

        $results = [];
        $homeWins = 0;
        $awayWins = 0;
        $gap = false;

        foreach (range(1, 5) as $number) {
            $row = $validated['sets'][$number] ?? [];

            $home = $row['home'] ?? null;
            $away = $row['away'] ?? null;

            $empty = ($home === null || $home === '')
                && ($away === null || $away === '');

            if ($empty) {
                $gap = true;
                continue;
            }

            if ($gap || $home === null || $away === null) {
                throw ValidationException::withMessages([
                    'sets' => 'Setet duhet me u plotesu me radhe, me dy rezultate.',
                ]);
            }

            if ($homeWins === 3 || $awayWins === 3) {
                throw ValidationException::withMessages([
                    'sets' => 'Ndeshja ka perfundu para ketij seti.',
                ]);
            }

            $winner = $this->winner((int) $home, (int) $away, $number);

            if (!$winner) {
                throw ValidationException::withMessages([
                    'sets' => "Rezultati i Setit {$number} nuk eshte valid.",
                ]);
            }

            $results[] = [
                'number' => $number,
                'home' => (int) $home,
                'away' => (int) $away,
            ];

            $winner === 'home' ? $homeWins++ : $awayWins++;
        }

        if (max($homeWins, $awayWins) !== 3) {
            throw ValidationException::withMessages([
                'sets' => 'Per perfundimin e ndeshjes, nje ekip duhet me fitu 3 sete.',
            ]);
        }

        DB::transaction(function () use (
            $ndeshja, $results, $homeWins, $awayWins
        ) {
            Ndeshja::query()
                ->lockForUpdate()
                ->findOrFail($ndeshja->id);

            $match = $this->matchRecord($ndeshja->id);

            if ($match && $match->mode === 'live') {
                throw ValidationException::withMessages([
                    'sets' => 'Kjo ndeshje eshte regjistruar LIVE. Nuk mund te mbishkruhet manualisht.',
                ]);
            }

            $now = now();

            if (!$match) {
                $id = DB::table('match_center_matches')
                    ->insertGetId([
                        'ndeshja_id' => $ndeshja->id,
                        'mode' => 'manual',
                        'status' => 'finished',
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
            } else {
                $id = $match->id;

                DB::table('match_center_sets')
                    ->where('match_center_match_id', $id)
                    ->delete();

                DB::table('match_center_matches')
                    ->where('id', $id)
                    ->update([
                        'mode' => 'manual',
                        'status' => 'finished',
                        'updated_at' => $now,
                    ]);
            }

            foreach ($results as $row) {
                DB::table('match_center_sets')->insert([
                    'match_center_match_id' => $id,
                    'set_number' => $row['number'],
                    'home_points' => $row['home'],
                    'away_points' => $row['away'],
                    'is_completed' => true,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            $this->syncFinished($ndeshja, [
                'home' => $homeWins,
                'away' => $awayWins,
            ]);
        });

        return redirect()
            ->route('match-center.show', $ndeshja)
            ->with('success', 'Rezultati perfundimtar u ruajt.');
    }

    public function start(Request $request, Ndeshja $ndeshja)
    {
        $this->canManage($request, $ndeshja);

        DB::transaction(function () use ($ndeshja) {
            Ndeshja::query()
                ->lockForUpdate()
                ->findOrFail($ndeshja->id);

            if ($this->matchRecord($ndeshja->id)) {
                throw ValidationException::withMessages([
                    'live' => 'Kjo ndeshje ka rezultat ose sesion ekzistues.',
                ]);
            }

            $now = now();

            $id = DB::table('match_center_matches')->insertGetId([
                'ndeshja_id' => $ndeshja->id,
                'mode' => 'live',
                'status' => 'live',
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            DB::table('match_center_sets')->insert([
                'match_center_match_id' => $id,
                'set_number' => 1,
                'home_points' => 0,
                'away_points' => 0,
                'is_completed' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        });

        return redirect()
            ->route('match-center.show', $ndeshja)
            ->with('success', 'Ndeshja LIVE filloi.');
    }

    public function point(Request $request, Ndeshja $ndeshja)
    {
        $this->canManage($request, $ndeshja);

        $validated = $request->validate([
            'team' => ['required', 'in:home,away'],
        ]);

        DB::transaction(function () use ($ndeshja, $request, $validated) {
            $match = DB::table('match_center_matches')
                ->where('ndeshja_id', $ndeshja->id)
                ->lockForUpdate()
                ->first();

            abort_unless($match && $match->status === 'live', 409);

            $sets = $this->scores($match->id);
            $current = $sets->last();

            abort_unless($current && !$current->is_completed, 409);

            $home = (int) $current->home_points;
            $away = (int) $current->away_points;

            if ($validated['team'] === 'home') {
                $home++;
            } else {
                $away++;
            }

            $now = now();

            DB::table('match_center_events')->insert([
                'match_center_set_id' => $current->id,
                'team' => $validated['team'],
                'user_id' => $request->user()->id,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $winner = $this->winner(
                $home, $away, (int) $current->set_number
            );

            DB::table('match_center_sets')
                ->where('id', $current->id)
                ->update([
                    'home_points' => $home,
                    'away_points' => $away,
                    'is_completed' => $winner !== null,
                    'updated_at' => $now,
                ]);

            if ($winner !== null) {
                $updatedSets = $this->scores($match->id);
                $summary = $this->summary($updatedSets);

                if (max($summary['home'], $summary['away']) === 3) {
                    DB::table('match_center_matches')
                        ->where('id', $match->id)
                        ->update([
                            'status' => 'finished',
                            'updated_at' => $now,
                        ]);

                    $this->syncFinished($ndeshja, $summary);
                } else {
                    DB::table('match_center_sets')->insert([
                        'match_center_match_id' => $match->id,
                        'set_number' => $current->set_number + 1,
                        'home_points' => 0,
                        'away_points' => 0,
                        'is_completed' => false,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }
        });

        return response()->json(['ok' => true]);
    }

    public function undo(Request $request, Ndeshja $ndeshja)
    {
        $this->canManage($request, $ndeshja);

        DB::transaction(function () use ($ndeshja) {
            $match = DB::table('match_center_matches')
                ->where('ndeshja_id', $ndeshja->id)
                ->lockForUpdate()
                ->first();

            abort_unless($match && $match->mode === 'live', 409);

            $sets = $this->scores($match->id);

            $event = DB::table('match_center_events')
                ->whereIn('match_center_set_id', $sets->pluck('id'))
                ->orderByDesc('id')
                ->first();

            abort_unless($event, 409);

            $set = $sets->firstWhere('id', $event->match_center_set_id);

            // Hiq setet e zbrazeta te krijuara pas pikes fituese.
            DB::table('match_center_sets')
                ->where('match_center_match_id', $match->id)
                ->where('set_number', '>', $set->set_number)
                ->whereNotExists(function ($q) {
                    $q->selectRaw('1')
                        ->from('match_center_events')
                        ->whereColumn(
                            'match_center_events.match_center_set_id',
                            'match_center_sets.id'
                        );
                })
                ->delete();

            DB::table('match_center_events')
                ->where('id', $event->id)
                ->delete();

            DB::table('match_center_sets')
                ->where('id', $set->id)
                ->update([
                    'home_points' => (int) $set->home_points
                        - ($event->team === 'home' ? 1 : 0),
                    'away_points' => (int) $set->away_points
                        - ($event->team === 'away' ? 1 : 0),
                    'is_completed' => false,
                    'updated_at' => now(),
                ]);

            DB::table('match_center_matches')
                ->where('id', $match->id)
                ->update([
                    'status' => 'live',
                    'updated_at' => now(),
                ]);

            // Ndeshja e perfunduar LIVE rikthehet si aktive.
            // Statusi ne tabelen ekzistuese nuk ndryshohet
            // ketu per te shmangur konflikte me enum/statuset
            // e modulit ekzistues.
        });

        return response()->json(['ok' => true]);
    }

    public function state(Request $request, Ndeshja $ndeshja)
    {
        $this->canManage($request, $ndeshja);

        $match = $this->matchRecord($ndeshja->id);
        $sets = $match ? $this->scores($match->id) : collect();
        $summary = $this->summary($sets);

        return response()->json([
            'status' => $match->status ?? 'draft',
            'mode' => $match->mode ?? null,
            'sets' => $sets->map(fn ($set) => [
                'number' => (int) $set->set_number,
                'home' => (int) $set->home_points,
                'away' => (int) $set->away_points,
                'completed' => (bool) $set->is_completed,
            ])->values(),
            'summary' => $summary,
        ])->header('Cache-Control', 'no-store');
    }
}
