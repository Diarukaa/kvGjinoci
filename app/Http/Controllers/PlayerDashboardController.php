<?php

namespace App\Http\Controllers;

use App\Models\Ekipi;
use App\Models\Ndeshja;
use App\Models\Prezenca;
use App\Models\StatistikaLojtarit;
use App\Models\Stervitja;
use App\Models\Trajner;
use Illuminate\Http\Request;

class PlayerDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        abort_unless($user->role === 'player', 403);

        $lojtar = $user->lojtar;

        // Llogaria ende nuk eshte lidhur me profilin

        if (!$lojtar) {

            return view('dashboards.player', [
                'lojtar' => null,
            ]);

        }

        // Ekipi dhe trajneri

        $ekipi = Ekipi::find($lojtar->ekipi_id);

        $trajner = $ekipi
            ? Trajner::find($ekipi->trajner_id)
            : null;

        // Statistikat personale

        $statistikat = StatistikaLojtarit::where(
            'lojtar_id',
            $lojtar->id
        )->get();

        $ndeshjetMap = Ndeshja::whereIn(
            'id',
            $statistikat->pluck('ndeshja_id')
        )
            ->where('statusi', 'Perfunduar')
            ->get()
            ->keyBy('id');

        $statistikat = $statistikat
            ->filter(
                fn($statistika) => $ndeshjetMap->has(
                    $statistika->ndeshja_id
                )
            )
            ->sortByDesc(function ($statistika) use ($ndeshjetMap) {

                return $ndeshjetMap
                    ->get($statistika->ndeshja_id)
                    ->data_ndeshjes;

            })
            ->values();

        // Totalet individuale

        $totalKills = (int) $statistikat->sum('kills');

        $totalAces = (int) $statistikat->sum('aces');

        $totalBlocks = (int) $statistikat->sum('blocks');

        $totalDigs = (int) $statistikat->sum('digs');

        $totalPike =
            $totalKills +
            $totalAces +
            $totalBlocks;

        $totalNdeshje = $statistikat
            ->pluck('ndeshja_id')
            ->unique()
            ->count();

        $mesatarja = $totalNdeshje > 0
            ? round($totalPike / $totalNdeshje, 1)
            : 0;

        // Prezenca personale

        $prezencat = Prezenca::where(
            'lojtar_id',
            $lojtar->id
        )->get();

        $stervitjetMap = Stervitja::whereIn(
            'id',
            $prezencat->pluck('stervitja_id')
        )
            ->where('statusi', 'Perfunduar')
            ->get()
            ->keyBy('id');

        $prezencat = $prezencat
            ->filter(
                fn($prezenca) => $stervitjetMap->has(
                    $prezenca->stervitja_id
                )
            )
            ->sortByDesc(function ($prezenca) use ($stervitjetMap) {

                return $stervitjetMap
                    ->get($prezenca->stervitja_id)
                    ->data;

            })
            ->values();

        $totalPrezenca = $prezencat
            ->where('statusi', 'Prezente')
            ->count();

        $totalMungesa = $prezencat
            ->where('statusi', 'Mungon')
            ->count();

        $totalVonesa = $prezencat
            ->where('statusi', 'Me vonese')
            ->count();

        $totalArsyetuara = $prezencat
            ->where('statusi', 'E arsyetuar')
            ->count();

        $totalRegjistrime = $prezencat->count();

        $perqindjaPrezences = $totalRegjistrime > 0
            ? round(
                (($totalPrezenca + $totalVonesa)
                    / $totalRegjistrime) * 100,
                1
            )
            : null;

        // Orari i ekipit aktual

        $ndeshjetArdhshme = collect();

        $stervitjetArdhshme = collect();

        $rezultatetEkipit = collect();

        if ($ekipi) {

            $ndeshjetArdhshme = Ndeshja::where(
                'ekipi_id',
                $ekipi->id
            )
                ->where('statusi', 'Planifikuar')
                ->where(
                    'data_ndeshjes',
                    '>=',
                    now()
                )
                ->orderBy('data_ndeshjes')
                ->get();

            $stervitjetArdhshme = Stervitja::where(
                'ekipi_id',
                $ekipi->id
            )
                ->where('statusi', 'Planifikuar')
                ->where(function ($query) {

                    $query->whereDate(
                        'data',
                        '>',
                        today()
                    )
                        ->orWhere(function ($query) {

                            $query->whereDate(
                                'data',
                                today()
                            )
                                ->where(
                                    'ora_fillimit',
                                    '>=',
                                    now()->format('H:i:s')
                                );

                        });

                })
                ->orderBy('data')
                ->orderBy('ora_fillimit')
                ->get();

            $rezultatetEkipit = Ndeshja::where(
                'ekipi_id',
                $ekipi->id
            )
                ->where('statusi', 'Perfunduar')
                ->orderByDesc('data_ndeshjes')
                ->limit(5)
                ->get();

        }

        return view('dashboards.player', compact(

            'lojtar',
            'ekipi',
            'trajner',

            'statistikat',
            'ndeshjetMap',

            'totalKills',
            'totalAces',
            'totalBlocks',
            'totalDigs',
            'totalPike',
            'totalNdeshje',
            'mesatarja',

            'prezencat',
            'stervitjetMap',

            'totalPrezenca',
            'totalMungesa',
            'totalVonesa',
            'totalArsyetuara',
            'totalRegjistrime',
            'perqindjaPrezences',

            'ndeshjetArdhshme',
            'stervitjetArdhshme',
            'rezultatetEkipit'

        ));
    }
}
