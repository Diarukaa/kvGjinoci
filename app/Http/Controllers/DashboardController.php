<?php

namespace App\Http\Controllers;

use App\Models\Lojtar;
use App\Models\Trajner;
use App\Models\Ekipi;
use App\Models\Ndeshja;
use App\Models\Manager;
use App\Models\Stervitja;
use App\Models\Klubi;
use App\Models\Kampionati;
use App\Models\Sezoni;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLojtare = Lojtar::count();
        $totalTrajnere = Trajner::count();
        $totalEkipe = Ekipi::count();
        $totalNdeshje = Ndeshja::count();
        $totalManagers = Manager::count();
        $totalStervitje = Stervitja::count();
        $totalKlube = Klubi::count();
        $totalKampionate = Kampionati::count();

        $sezoniAktiv = Sezoni::where('aktiv', true)
            ->orderByDesc('data_fillimit')
            ->first();

        $ndeshjetEArdhshme = Ndeshja::with('ekipi')
            ->where('statusi', 'Planifikuar')
            ->where('data_ndeshjes', '>=', now())
            ->orderBy('data_ndeshjes')
            ->take(3)
            ->get();

        $stervitjetEArdhshme = Stervitja::with('ekipi')
            ->where('statusi', 'Planifikuar')
            ->whereDate('data', '>=', today())
            ->orderBy('data')
            ->orderBy('ora_fillimit')
            ->take(3)
            ->get();

        return view('dashboard', compact(
            'totalLojtare',
            'totalTrajnere',
            'totalEkipe',
            'totalNdeshje',
            'totalManagers',
            'totalStervitje',
            'totalKlube',
            'totalKampionate',
            'sezoniAktiv',
            'ndeshjetEArdhshme',
            'stervitjetEArdhshme'
        ));
    }
}
