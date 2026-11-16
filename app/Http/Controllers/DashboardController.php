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
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Vetem administratori

        abort_unless(
            $request->user()->role === 'admin',
            403
        );

        // STATISTIKAT KRYESORE

        $totalLojtare = Lojtar::count();

        $totalTrajnere = Trajner::count();

        $totalEkipe = Ekipi::count();

        $totalManagers = Manager::count();

        $totalNdeshje = Ndeshja::count();

        $totalStervitje = Stervitja::count();

        // REZULTATET SPORTIVE

        $fitore = Ndeshja::query()

            ->where('statusi', 'Perfunduar')

            ->whereColumn(
                'setet_tona',
                '>',
                'setet_kundershtarit'
            )

            ->count();

        $humbje = Ndeshja::query()

            ->where('statusi', 'Perfunduar')

            ->whereColumn(
                'setet_tona',
                '<',
                'setet_kundershtarit'
            )

            ->count();

        $ndeshjePerfunduara = Ndeshja::query()

            ->where('statusi', 'Perfunduar')

            ->count();

        $ndeshjePlanifikuara = Ndeshja::query()

            ->where('statusi', 'Planifikuar')

            ->count();

        $totalRezultate = $fitore + $humbje;

        $winRate = $totalRezultate > 0

            ? round(
                ($fitore / $totalRezultate) * 100,
                1
            )

            : 0;

        // NDESHJET E ARDHSHME

        $ndeshjetEArdhshme = Ndeshja::query()

            ->with('ekipi')

            ->where('statusi', 'Planifikuar')

            ->whereDate(
                'data_ndeshjes',
                '>=',
                today()
            )

            ->orderBy('data_ndeshjes')

            ->limit(5)

            ->get();

        // STERVITJET E ARDHSHME

        $stervitjetEArdhshme = Stervitja::query()

            ->with('ekipi')

            ->where('statusi', 'Planifikuar')

            ->whereDate(
                'data',
                '>=',
                today()
            )

            ->orderBy('data')

            ->orderBy('ora_fillimit')

            ->limit(5)

            ->get();

        // REZULTATET E FUNDIT

        $rezultatetEFundit = Ndeshja::query()

            ->with('ekipi')

            ->where('statusi', 'Perfunduar')

            ->orderByDesc('data_ndeshjes')

            ->limit(5)

            ->get();

        // FINANCAT

        $totalKontrata = Kontrata::count();

        $totalPagesa = Pagesa::count();

        // AKTIVITETET E FUNDIT

        $aktivitetetEFundit = ActivityLog::query()

            ->latest()

            ->limit(5)

            ->get();

        // DASHBOARD VIEW

        return view('dashboard', compact(

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

            'aktivitetetEFundit'

        ));
    }
}
