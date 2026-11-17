<?php

namespace App\Http\Controllers;

use App\Models\Ndeshja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MatchCenterOverviewController extends Controller
{
    public function index(Request $request)
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
            $query->whereHas(
                'ekipi',
                fn ($q) => $q->where(
                    'trajner_id',
                    $user->trajner_id ?? 0
                )
            );
        }

        $filter = $request->query('filter', 'all');

        if (!in_array(
            $filter,
            ['all', 'finished', 'live', 'pending'],
            true
        )) {
            $filter = 'all';
        }

        $ndeshjet = $query
            ->orderByDesc('data_ndeshjes')
            ->orderByDesc('id')
            ->get();

        $records = DB::table('match_center_matches')
            ->whereIn('ndeshja_id', $ndeshjet->pluck('id'))
            ->get()
            ->keyBy('ndeshja_id');

        $completedStatuses = [
            'perfunduar',
            'e perfunduar',
            'përfunduar',
            'e përfunduar',
            'finished',
            'completed',
            'ended',
        ];

        $rows = $ndeshjet->map(function ($ndeshja) use (
            $records,
            $completedStatuses
        ) {
            $record = $records->get($ndeshja->id);

            $status = mb_strtolower(
                trim((string) ($ndeshja->statusi ?? ''))
            );

            $homeSets = is_numeric($ndeshja->setet_tona ?? null)
                ? (int) $ndeshja->setet_tona
                : null;

            $awaySets = is_numeric(
                $ndeshja->setet_kundershtarit ?? null
            )
                ? (int) $ndeshja->setet_kundershtarit
                : null;

            $legacyFinished = in_array(
                    $status,
                    $completedStatuses,
                    true
                ) || $homeSets === 3 || $awaySets === 3;

            if ($record && $record->status === 'live') {
                $category = 'live';
                $source = 'live';
            } elseif ($record && $record->status === 'finished') {
                $category = 'finished';
                $source = $record->mode;
            } elseif ($legacyFinished) {
                $category = 'finished';
                $source = 'existing';
            } else {
                $category = 'pending';
                $source = 'none';
            }

            return [
                'ndeshja' => $ndeshja,
                'record' => $record,
                'category' => $category,
                'source' => $source,
                'home_sets' => $homeSets,
                'away_sets' => $awaySets,
                'legacy_finished' => $legacyFinished,
            ];
        });

        $counts = [
            'all' => $rows->count(),
            'finished' => $rows
                ->where('category', 'finished')->count(),
            'live' => $rows
                ->where('category', 'live')->count(),
            'pending' => $rows
                ->where('category', 'pending')->count(),
        ];

        if ($filter !== 'all') {
            $rows = $rows
                ->where('category', $filter)
                ->values();
        }

        $perPage = 12;
        $page = max(1, (int) $request->query('page', 1));

        $ndeshjetMeStatus = new \Illuminate\Pagination\LengthAwarePaginator(
            $rows->forPage($page, $perPage)->values(),
            $rows->count(),
            $perPage,
            $page,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        return view('match-center.overview', compact(
            'ndeshjetMeStatus',
            'counts',
            'filter'
        ));
    }
}
