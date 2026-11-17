<?php

namespace App\Http\Controllers;

use App\Models\Lojtar;
use App\Models\Trajner;
use App\Models\Ekipi;
use App\Models\Ndeshja;
use App\Models\Manager;
use App\Models\Stervitja;
use App\Models\Kontrata;
use App\Models\Pagesa;
use App\Models\ActivityLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private function winnerOfSet(object $set): ?string
    {
        $home = (int) $set->home_points;
        $away = (int) $set->away_points;

        $minimum = (int) $set->set_number === 5
            ? 15
            : 25;

        if (
            !(bool) $set->is_completed ||
            max($home, $away) < $minimum ||
            abs($home - $away) < 2
        ) {
            return null;
        }

        return $home > $away ? 'home' : 'away';
    }

    private function isFinished(?string $status): bool
    {
        return in_array(
            mb_strtolower(trim((string) $status)),
            [
                'perfunduar',
                'përfunduar',
                'e perfunduar',
                'e përfunduar',
                'finished',
                'completed',
                'ended',
            ],
            true
        );
    }

    public function index(Request $request)
    {
        // Vetem administratori.

        abort_unless(
            $request->user()?->role === 'admin',
            403
        );

        // STATISTIKAT KRYESORE

        $totalLojtare = Lojtar::count();
        $totalTrajnere = Trajner::count();
        $totalEkipe = Ekipi::count();
        $totalManagers = Manager::count();
        $totalNdeshje = Ndeshja::count();
        $totalStervitje = Stervitja::count();

        // NDESHJET EKZISTUESE

        $ndeshjet = Ndeshja::query()
            ->with('ekipi')
            ->get();

        // MATCH CENTER

        $records = DB::table('match_center_matches')
            ->whereIn(
                'ndeshja_id',
                $ndeshjet->pluck('id')
            )
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

        $today = Carbon::today();

        // BASHKIMI I REZULTATEVE

        $matches = $ndeshjet->map(
            function (Ndeshja $ndeshja) use (
                $records,
                $setsByMatch
            ) {
                $record = $records->get($ndeshja->id);

                $date = $ndeshja->data_ndeshjes
                    ? Carbon::parse(
                        $ndeshja->data_ndeshjes
                    )
                    : null;

                $legacyHome = is_numeric(
                    $ndeshja->setet_tona ?? null
                )
                    ? (int) $ndeshja->setet_tona
                    : null;

                $legacyAway = is_numeric(
                    $ndeshja->setet_kundershtarit ?? null
                )
                    ? (int) $ndeshja->setet_kundershtarit
                    : null;

                $legacyFinished = $this->isFinished(
                        $ndeshja->statusi ?? null
                    ) || $legacyHome === 3
                    || $legacyAway === 3;

                // Statusi i Match Center ka perparesi.
                // Kjo eshte e rendesishme pas Undo.

                if (
                    $record &&
                    $record->status === 'live'
                ) {
                    $status = 'live';
                } elseif (
                    $record &&
                    $record->status === 'finished'
                ) {
                    $status = 'finished';
                } elseif ($legacyFinished) {
                    $status = 'finished';
                } else {
                    $status = 'pending';
                }

                $home = $legacyHome;
                $away = $legacyAway;

                $currentSet = null;
                $currentHome = 0;
                $currentAway = 0;

                if ($record) {
                    $recordSets = $setsByMatch->get(
                        $record->id,
                        collect()
                    );

                    if ($recordSets->isNotEmpty()) {
                        $centerHome = 0;
                        $centerAway = 0;

                        foreach ($recordSets as $set) {
                            $winner = $this->winnerOfSet(
                                $set
                            );

                            if ($winner === 'home') {
                                $centerHome++;
                            } elseif ($winner === 'away') {
                                $centerAway++;
                            }
                        }

                        if (
                            in_array(
                                $record->status,
                                ['live', 'finished'],
                                true
                            )
                        ) {
                            $home = $centerHome;
                            $away = $centerAway;
                        }

                        $last = $recordSets->last();

                        $currentSet =
                            (int) $last->set_number;

                        $currentHome =
                            (int) $last->home_points;

                        $currentAway =
                            (int) $last->away_points;
                    }
                }

                return [
                    'ndeshja' => $ndeshja,
                    'date' => $date,
                    'status' => $status,
                    'home' => $home,
                    'away' => $away,
                    'current_set' => $currentSet,
                    'current_home' => $currentHome,
                    'current_away' => $currentAway,
                    'legacy' => !$record && $legacyFinished,
                ];
            }
        );

        // FITORET

        $fitore = $matches->filter(
            fn ($row) =>
                $row['status'] === 'finished'
                && $row['home'] !== null
                && $row['away'] !== null
                && $row['home'] > $row['away']
        )->count();

        // HUMBJET

        $humbje = $matches->filter(
            fn ($row) =>
                $row['status'] === 'finished'
                && $row['home'] !== null
                && $row['away'] !== null
                && $row['home'] < $row['away']
        )->count();

        // STATISTIKAT E NDESHJEVE

        $ndeshjePerfunduara = $matches
            ->where('status', 'finished')
            ->count();

        $ndeshjePlanifikuara = $matches
            ->where('status', 'pending')
            ->count();

        $totalRezultate = $fitore + $humbje;

        $winRate = $totalRezultate > 0
            ? round(
                ($fitore / $totalRezultate) * 100,
                1
            )
            : 0;

        // NDESHJET LIVE

        $liveMatches = $matches
            ->where('status', 'live')
            ->values();

        // NDESHJET E ARDHSHME

        $ndeshjetEArdhshme = $matches
            ->filter(
                fn ($row) =>
                    $row['status'] === 'pending'
                    && $row['date'] !== null
                    && $row['date']->gte($today)
            )
            ->sortBy('date')
            ->take(5)
            ->pluck('ndeshja')
            ->values();

        // REZULTATET E FUNDIT

        $rezultatetEFundit = $matches
            ->filter(
                fn ($row) =>
                    $row['status'] === 'finished'
            )
            ->sortByDesc(
                fn ($row) =>
                    $row['date']?->timestamp ?? 0
            )
            ->take(5)
            ->values();

        // STERVITJET E ARDHSHME

        $stervitjetEArdhshme = Stervitja::query()
            ->with('ekipi')
            ->where('statusi', 'Planifikuar')
            ->whereDate('data', '>=', today())
            ->orderBy('data')
            ->orderBy('ora_fillimit')
            ->limit(5)
            ->get();

        // FINANCAT

        $totalKontrata = Kontrata::count();
        $totalPagesa = Pagesa::count();

        // ACTIVITY LOG

        $aktivitetetEFundit = ActivityLog::query()
            ->latest()
            ->limit(5)
            ->get();

        // DASHBOARD

        return view(
            'dashboard',
            compact(
                'totalLojtare',
                'totalTrajnere',
                'totalEkipe',
                'totalManagers',
                'totalNdeshje',
                'totalStervitje',
                'fitore',
                'humbje',
                'ndeshjePerfunduara',
                'ndeshjePlanifikuara',
                'totalRezultate',
                'winRate',
                'ndeshjetEArdhshme',
                'stervitjetEArdhshme',
                'rezultatetEFundit',
                'totalKontrata',
                'totalPagesa',
                'aktivitetetEFundit',
                'liveMatches'
            )
        );
    }
}
