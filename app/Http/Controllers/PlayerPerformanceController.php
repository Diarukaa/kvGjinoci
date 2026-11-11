<?php

namespace App\Http\Controllers;

use App\Models\Ekipi;
use App\Models\Lojtar;
use App\Models\Ndeshja;
use App\Models\StatistikaLojtarit;
use App\Models\Sezoni;
use Illuminate\Http\Request;

class PlayerPerformanceController extends Controller
{
    public function index(Request $request)
    {

        $validated = $request->validate([
            'ekipi_id' => 'nullable|integer|exists:ekipet,id',
            'sezoni_id' => 'nullable|integer|exists:sezonet,id',
        ]);

        $ekipiId = $validated['ekipi_id'] ?? null;
        $sezoniId = $validated['sezoni_id'] ?? null;

        $ekipet = Ekipi::orderBy('emri')->get();
        $sezonet = Sezoni::orderByDesc('data_fillimit')->get();


        $lojtaret = Lojtar::query()
            ->with('ekipi')
            ->when($ekipiId, function ($query) use ($ekipiId) {
                $query->where('ekipi_id', $ekipiId);
            })

            ->withCount([
                'statistikat as ndeshje_luajtura' =>
                    function ($query) use ($sezoniId) {
                        $query->whereHas('ndeshja',
                            function ($q) use ($sezoniId) {
                                $q->where('statusi', 'Perfunduar')
                                    ->when($sezoniId, fn ($q) =>
                                    $q->where('sezoni_id', $sezoniId));
                            });
                    }
            ])

            ->withSum([
                'statistikat as total_kills' =>
                    function ($query) use ($sezoniId) {
                        $query->whereHas('ndeshja',
                            function ($q) use ($sezoniId) {
                                $q->where('statusi', 'Perfunduar')
                                    ->when($sezoniId, fn ($q) =>
                                    $q->where('sezoni_id', $sezoniId));
                            });
                    }
            ], 'kills')
            ->withSum([
                'statistikat as total_aces' =>
                    function ($query) use ($sezoniId) {
                        $query->whereHas('ndeshja',
                            function ($q) use ($sezoniId) {
                                $q->where('statusi', 'Perfunduar')
                                    ->when($sezoniId, fn ($q) =>
                                    $q->where('sezoni_id', $sezoniId));
                            });
                    }
            ], 'aces')


            ->withSum([
                'statistikat as total_blocks' =>
                    function ($query) use ($sezoniId) {
                        $query->whereHas('ndeshja',
                            function ($q) use ($sezoniId) {
                                $q->where('statusi', 'Perfunduar')
                                    ->when($sezoniId, fn ($q) =>
                                    $q->where('sezoni_id', $sezoniId));
                            });
                    }
            ], 'blocks')

            ->withSum([
                'statistikat as total_digs' =>
                    function ($query) use ($sezoniId) {
                        $query->whereHas('ndeshja',
                            function ($q) use ($sezoniId) {
                                $q->where('statusi', 'Perfunduar')
                                    ->when($sezoniId, fn ($q) =>
                                    $q->where('sezoni_id', $sezoniId));
                            });
                    }
            ], 'digs')
            ->get()
            ->map(function ($lojtar) {
                $lojtar->total_pike =
                    (int) $lojtar->total_kills +
                    (int) $lojtar->total_aces +
                    (int) $lojtar->total_blocks;

                $lojtar->mesatarja = $lojtar->ndeshje_luajtura > 0
                    ? round(
                        $lojtar->total_pike / $lojtar->ndeshje_luajtura,
                        2
                    )
                    : 0;

                return $lojtar;
            })
            ->sortByDesc('total_pike')
            ->values();

        $top5 = $lojtaret
            ->filter(fn ($lojtar) => $lojtar->ndeshje_luajtura > 0)
            ->take(5);

        $totalLojtare = $lojtaret->count();

        $totalPike = $lojtaret->sum('total_pike');

        $totalNdeshje = Ndeshja::query()
            ->where('statusi', 'Perfunduar')
            ->when($ekipiId, fn ($query) =>
            $query->where('ekipi_id', $ekipiId))
            ->when($sezoniId, fn ($query) =>
            $query->where('sezoni_id', $sezoniId))
            ->count();

        $mesatarjaMeELarte = $lojtaret
            ->max('mesatarja') ?? 0;


        return view('performance.index', compact(
            'lojtaret',
            'ekipet',
            'ekipiId',
            'sezonet',
            'sezoniId',
            'top5',
            'totalLojtare',
            'totalPike',
            'totalNdeshje',
            'mesatarjaMeELarte'
        ));
    }
}
