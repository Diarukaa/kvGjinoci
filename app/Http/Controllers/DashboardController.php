<?php

namespace App\Http\Controllers;

use App\Models\Lojtar;
use App\Models\Trajner;
use App\Models\Ekipi;
use App\Models\Ndeshja;
use App\Models\Manager;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLojtare = Lojtar::count();
        $totalTrajnere = Trajner::count();
        $totalEkipe = Ekipi::count();
        $totalNdeshje = Ndeshja::count();
        $totalManagers = Manager::count();

        return view('dashboard', compact(
            'totalLojtare',
            'totalTrajnere',
            'totalEkipe',
            'totalNdeshje',
            'totalManagers'
        ));
    }
}
