<?php

namespace App\Http\Controllers;

use App\Models\Ndeshja;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class NdeshjetV2Controller extends Controller
{
    private function accessible(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && in_array(
                $user->role,
                ['admin', 'manager', 'coach'],
                true
            ),
            403
        );

        $query = Ndeshja::query()->with('ekipi');

        if ($user->role === 'coach') {
            $query->whereHas('ekipi', function ($q) use ($user) {
                $q->where(
                    'trajner_id',
                    $user->trajner_id ?? 0
                );
            });
        }

        return $query;
    }

    private function isFinished(?string $status): bool
    {
        return in_array(
            mb_strtolower(trim((string) $status)),
            [
                'perfunduar',
                'e perfunduar',
                'përfunduar',
                'e përfunduar',
                'finished',
                'completed',
                'ended',
            ],
            true
        );
    }

    private function setWinner(
        int $home,
        int $away,
        int $number
    ): ?string {
        $minimum = $number === 5 ? 15 : 25;

        if (
            max($home, $away) < $minimum
            || abs($home - $away) < 2
        ) {
            return null;
        }

        return $home > $away ? 'home' : 'away';
    }

    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => [
                'nullable',
                'string',
                'max:100',
            ],
            'status' => [
                'nullable',
                'in:all,pending,live,finished',
            ],
        ]);

        $search = trim($validated['search'] ?? '');
        $filter = $validated['status'] ?? 'all';

        $query = $this->accessible($request);

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where(
                    'kundershtari',
                    'like',
                    '%' . $search . '%'
                )->orWhereHas('ekipi', function ($team) use ($search) {
                    $team->where(
                        'emri',
                        'like',
                        '%' . $search . '%'
                    );
                });
            });
        }

        $ndeshjet = $query
            ->orderByDesc('data_ndeshjes')
            ->orderByDesc('id')
            ->get();

        $records = DB::table('match_center_matches')
            ->whereIn('ndeshja_id', $ndeshjet->pluck('id'))
            ->get()
            ->keyBy('ndeshja_id');

        $setsByMatch = DB::table('match_center_sets')
            ->whereIn(
                'match_center_match_id',
                $records->pluck('id')
            )
            ->orderBy('set_number')
            ->get()
            ->groupBy('match_center_match_id');

        $rows = $ndeshjet->map(function ($ndeshja) use (
            $records,
            $setsByMatch
        ) {
            $record = $records->get($ndeshja->id);

            $sets = $record
                ? $setsByMatch->get($record->id, collect())
                : collect();

            $homeWins = 0;
            $awayWins = 0;
            $setDetails = [];

            foreach ($sets as $set) {
                $winner = $this->setWinner(
                    (int) $set->home_points,
                    (int) $set->away_points,
                    (int) $set->set_number
                );

                if ($set->is_completed && $winner === 'home') {
                    $homeWins++;
                }

                if ($set->is_completed && $winner === 'away') {
                    $awayWins++;
                }

                $setDetails[] = [
                    'number' => (int) $set->set_number,
                    'home' => (int) $set->home_points,
                    'away' => (int) $set->away_points,
                    'completed' => (bool) $set->is_completed,
                ];
            }

            $oldHome = is_numeric(
                $ndeshja->setet_tona ?? null
            )
                ? (int) $ndeshja->setet_tona
                : null;

            $oldAway = is_numeric(
                $ndeshja->setet_kundershtarit ?? null
            )
                ? (int) $ndeshja->setet_kundershtarit
                : null;

            $legacyFinished = $this->isFinished(
                    $ndeshja->statusi ?? null
                ) || $oldHome === 3 || $oldAway === 3;

            if ($record && $record->status === 'live') {
                $status = 'live';
            } elseif (
                ($record && $record->status === 'finished')
                || $legacyFinished
            ) {
                $status = 'finished';
            } else {
                $status = 'pending';
            }

            $centerHasResult = $record
                && count($setDetails) > 0;

            $resultHome = $centerHasResult
                ? $homeWins
                : $oldHome;

            $resultAway = $centerHasResult
                ? $awayWins
                : $oldAway;

            return [
                'ndeshja' => $ndeshja,
                'status' => $status,
                'result_home' => $resultHome,
                'result_away' => $resultAway,
                'sets' => $setDetails,
                'record' => $record,
                'legacy' => !$record && $legacyFinished,
            ];
        });

        $counts = [
            'all' => $rows->count(),
            'pending' => $rows
                ->where('status', 'pending')
                ->count(),
            'live' => $rows
                ->where('status', 'live')
                ->count(),
            'finished' => $rows
                ->where('status', 'finished')
                ->count(),
        ];

        $filtered = $filter === 'all'
            ? $rows
            : $rows->where('status', $filter)->values();

        $page = max(1, (int) $request->query('page', 1));
        $perPage = 15;

        $paginated = new LengthAwarePaginator(
            $filtered->forPage($page, $perPage)->values(),
            $filtered->count(),
            $perPage,
            $page,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        return view('ndeshjet-v2.index', compact(
            'paginated',
            'counts',
            'filter',
            'search'
        ));
    }
}
