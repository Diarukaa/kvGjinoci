<?php

namespace App\Http\Controllers;

use App\Models\Ekipi;
use App\Models\Lojtar;
use App\Models\Trajner;
use App\Models\Ndeshja;
use App\Models\Stervitja;
use App\Models\Kampionati;
use App\Models\Klubi;
use App\Models\Sezoni;
use Illuminate\Http\Request;

class ManagerDashboardController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(
            $request->user()->role === 'manager',
            403
        );

        $totalEkipe = Ekipi::count();

        $totalLojtare = Lojtar::count();

        $totalTrajnere = Trajner::count();

        $totalNdeshje = Ndeshja::count();

        $totalStervitje = Stervitja::count();

        $totalKampionate = Kampionati::count();

        $totalKlube = Klubi::count();

        $totalSezone = Sezoni::count();

        $ndeshjetPerfunduar = Ndeshja::where(
            'statusi',
            'Perfunduar'
        )->count();

        $fitore = Ndeshja::where(
            'statusi',
            'Perfunduar'
        )
            ->whereColumn(
                'setet_tona',
                '>',
                'setet_kundershtarit'
            )
            ->count();

        $humbje = Ndeshja::where(
            'statusi',
            'Perfunduar'
        )
            ->whereColumn(
                'setet_tona',
                '<',
                'setet_kundershtarit'
            )
            ->count();

        $winRate = $ndeshjetPerfunduar > 0
            ? round(
                ($fitore / $ndeshjetPerfunduar) * 100,
                1
            )
            : 0;

        // Ndeshjet e ardhshme

        $ndeshjetArdhshme = Ndeshja::with('ekipi')
            ->where('statusi', 'Planifikuar')
            ->where('data_ndeshjes', '>=', now())
            ->orderBy('data_ndeshjes')
            ->limit(5)
            ->get();

        // Stervitjet e ardhshme

        $stervitjetArdhshme = Stervitja::with('ekipi')
            ->where('statusi', 'Planifikuar')
            ->where(function ($query) {

                $query->whereDate('data', '>', today())

                    ->orWhere(function ($query) {

                        $query->whereDate('data', today())
                            ->where(
                                'ora_fillimit',
                                '>=',
                                now()->format('H:i:s')
                            );

                    });

            })
            ->orderBy('data')
            ->orderBy('ora_fillimit')
            ->limit(5)
            ->get();

        // Rezultatet e fundit

        $rezultatetFundit = Ndeshja::with('ekipi')
            ->where('statusi', 'Perfunduar')
            ->orderByDesc('data_ndeshjes')
            ->limit(5)
            ->get();

        // Ekipet dhe numri i lojtareve

        $ekipet = Ekipi::orderBy('emri')->get();

        $lojtaretByTeam = Lojtar::selectRaw(
            'ekipi_id, COUNT(*) as total'
        )
            ->groupBy('ekipi_id')
            ->pluck('total', 'ekipi_id');

        $trajneret = Trajner::all()->keyBy('id');

        return view('dashboards.manager', compact(

            'totalEkipe',
            'totalLojtare',
            'totalTrajnere',
            'totalNdeshje',
            'totalStervitje',
            'totalKampionate',
            'totalKlube',
            'totalSezone',

            'ndeshjetPerfunduar',
            'fitore',
            'humbje',
            'winRate',

            'ndeshjetArdhshme',
            'stervitjetArdhshme',
            'rezultatetFundit',

            'ekipet',
            'lojtaretByTeam',
            'trajneret'

        ));
    }
}
