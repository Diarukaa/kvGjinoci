<?php

namespace App\Http\Controllers;

use App\Models\Ekipi;
use App\Models\Lojtar;
use App\Models\Stervitja;
use App\Models\Ndeshja;
use Illuminate\Http\Request;

class CoachDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $trajner = $user->trajner;

        // Nese llogaria nuk eshte lidhur ende
        if (!$trajner) {

            return view('dashboards.coach', [
                'trajner' => null,
                'ekipet' => collect(),
                'lojtaret' => collect(),
                'totalEkipe' => 0,
                'totalLojtare' => 0,
                'totalStervitje' => 0,
                'totalNdeshje' => 0,
            ]);

        }

        // Vetem ekipet e ketij trajneri
        $ekipet = Ekipi::where(
            'trajner_id',
            $trajner->id
        )->get();

        $ekipiIds = $ekipet->pluck('id');

        // Vetem lojtaret e ekipeve te tij
        $lojtaret = Lojtar::whereIn(
            'ekipi_id',
            $ekipiIds
        )->orderBy('emri')->get();

        $totalEkipe = $ekipet->count();

        $totalLojtare = $lojtaret->count();

        // Vetem stervitjet e ekipeve te tij
        $totalStervitje = Stervitja::whereIn(
            'ekipi_id',
            $ekipiIds
        )->count();

        // Vetem ndeshjet e ekipeve te tij
        $totalNdeshje = Ndeshja::whereIn(
            'ekipi_id',
            $ekipiIds
        )->count();

        return view('dashboards.coach', compact(
            'trajner',
            'ekipet',
            'lojtaret',
            'totalEkipe',
            'totalLojtare',
            'totalStervitje',
            'totalNdeshje'
        ));
    }
}
