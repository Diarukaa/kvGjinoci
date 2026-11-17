<?php

namespace App\Http\Controllers;

use App\Models\Ndeshja;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaneliKlubitController extends Controller
{
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

    public function index(Request $request)
    {
        $ndeshjet = $this->accessible($request)
            ->orderByDesc('data_ndeshjes')
            ->orderByDesc('id')
            ->get();

        $records = DB::table('match_center_matches')
            ->whereIn('ndeshja_id', $ndeshjet->pluck('id'))
            ->get()
            ->keyBy('ndeshja_id');

        $sets = DB::table('match_center_sets')
            ->whereIn(
                'match_center_match_id',
                $records->pluck('id')
            )
            ->orderBy('set_number')
            ->get()
            ->groupBy('match_center_match_id');

        $today = Carbon::today();

        $rows = $ndeshjet->map(function ($ndeshja) use (
            $records,
            $sets,
            $today
        ) {
            $record = $records->get($ndeshja->id);

            $date = null;

            if ($ndeshja->data_ndeshjes) {
                try {
                    $date = Carbon::parse(
                        $ndeshja->data_ndeshjes
                    );
                } catch (\Throwable $e) {
                    $date = null;
                }
            }

            $legacyHome = is_numeric(
                $ndeshja->setet_tona ?? null
            ) ? (int) $ndeshja->setet_tona : null;

            $legacyAway = is_numeric(
                $ndeshja->setet_kundershtarit ?? null
            ) ? (int) $ndeshja->setet_kundershtarit : null;

            $legacyFinished = $this->isFinished(
                    $ndeshja->statusi ?? null
                ) || $legacyHome === 3 || $legacyAway === 3;

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

            $home = $legacyHome;
            $away = $legacyAway;

            if ($record && $record->status === 'finished') {
                $recordSets = $sets->get(
                    $record->id,
                    collect()
                );

                if ($recordSets->isNotEmpty()) {
                    $home = 0;
                    $away = 0;

                    foreach ($recordSets as $set) {
                        if (!$set->is_completed) {
                            continue;
                        }

                        $pointsHome = (int) $set->home_points;
                        $pointsAway = (int) $set->away_points;
                        $target = (int) $set->set_number === 5
                            ? 15 : 25;

                        if (
                            max($pointsHome, $pointsAway) < $target
                            || abs($pointsHome - $pointsAway) < 2
                        ) {
                            continue;
                        }

                        if ($pointsHome > $pointsAway) {
                            $home++;
                        } else {
                            $away++;
                        }
                    }
                }
            }

            return [
                'ndeshja' => $ndeshja,
                'date' => $date,
                'status' => $status,
                'home' => $home,
                'away' => $away,
                'legacy' => !$record && $legacyFinished,
            ];
        });

        $stats = [
            'total' => $rows->count(),
            'finished' => $rows
                ->where('status', 'finished')
                ->count(),
            'live' => $rows
                ->where('status', 'live')
                ->count(),
            'upcoming' => $rows
                ->filter(
                    fn ($row) =>
                        $row['status'] === 'pending'
                        && $row['date'] !== null
                        && $row['date']->greaterThanOrEqualTo($today)
                )
                ->count(),
        ];

        $liveMatches = $rows
            ->where('status', 'live')
            ->values();

        $recentMatches = $rows
            ->where('status', 'finished')
            ->take(5)
            ->values();

        $upcomingMatches = $rows
            ->filter(
                fn ($row) =>
                    $row['status'] === 'pending'
                    && $row['date'] !== null
                    && $row['date']->greaterThanOrEqualTo($today)
            )
            ->sortBy('date')
            ->take(5)
            ->values();

        return view('paneli-klubit.index', compact(
            'stats',
            'liveMatches',
            'recentMatches',
            'upcomingMatches'
        ));
    }
}
