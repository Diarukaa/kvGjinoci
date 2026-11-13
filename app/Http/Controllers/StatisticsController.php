<?php

namespace App\Http\Controllers;

use App\Models\Ekipi;
use App\Models\Ndeshja;

class StatisticsController extends Controller
{
    public function index()
    {
        $ekipet = Ekipi::with([
            'ndeshjet' => function ($query) {
                $query->where('statusi', 'Perfunduar');
            }
        ])->get();

        $statistikat = $ekipet->map(function ($ekipi) {
            $fitore = 0;
            $humbje = 0;
            $setetFituara = 0;
            $setetHumbura = 0;
            $piket = 0;

            foreach ($ekipi->ndeshjet as $ndeshja) {
                $tona = (int) $ndeshja->setet_tona;
                $kundershtarit =
                    (int) $ndeshja->setet_kundershtarit;

                $setetFituara += $tona;
                $setetHumbura += $kundershtarit;

                if ($tona > $kundershtarit) {
                    $fitore++;

                    $piket += $kundershtarit === 2
                        ? 2
                        : 3;
                } else {
                    $humbje++;

                    if ($tona === 2) {
                        $piket++;
                    }
                }
            }

            $ndeshje = $fitore + $humbje;

            return [
                'ekipi' => $ekipi,
                'ndeshje' => $ndeshje,
                'fitore' => $fitore,
                'humbje' => $humbje,
                'setet_fituara' => $setetFituara,
                'setet_humbura' => $setetHumbura,
                'piket' => $piket,
                'perqindja' => $ndeshje > 0
                    ? round($fitore / $ndeshje * 100, 1)
                    : 0,
            ];
        })->sort(function ($a, $b) {
            return ($b['piket'] <=> $a['piket'])
                ?: (($b['setet_fituara'] - $b['setet_humbura'])
                    <=> ($a['setet_fituara'] - $a['setet_humbura']))
                    ?: strcmp($a['ekipi']->emri, $b['ekipi']->emri);
        })->values();

        $totalNdeshje = Ndeshja::where(
            'statusi', 'Perfunduar'
        )->count();

        $totalFitore = $statistikat->sum('fitore');

        $grafikuNdeshje = \App\Models\Ndeshja::query()
            ->where('statusi', 'Perfunduar')
            ->get();

        $grafikuFitore = $grafikuNdeshje
            ->filter(fn ($n) =>
                $n->setet_tona > $n->setet_kundershtarit
            )->count();

        $grafikuHumbje = $grafikuNdeshje
            ->filter(fn ($n) =>
                $n->setet_tona < $n->setet_kundershtarit
            )->count();

        $grafikuTotal = $grafikuNdeshje->count();

        $grafikuPerqindja = $grafikuTotal > 0
            ? round($grafikuFitore / $grafikuTotal * 100)
            : 0;

        return view('statistics.index', compact(
            'statistikat',
            'totalNdeshje',
            'totalFitore'
        ))->with(compact(
            'grafikuFitore',
            'grafikuHumbje',
            'grafikuTotal',
            'grafikuPerqindja'
        ));
    }
}
