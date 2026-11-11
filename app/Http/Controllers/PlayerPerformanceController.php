<?php

namespace App\Http\Controllers;

use App\Models\Ekipi;
use App\Models\Lojtar;
use App\Models\Ndeshja;
use App\Models\StatistikaLojtarit;
use Illuminate\Http\Request;

class PlayerPerformanceController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'ekipi_id' => 'nullable|integer|exists:ekipet,id',
        ]);

        $ekipiId = $validated['ekipi_id'] ?? null;

        $ekipet = Ekipi::orderBy('emri')->get();

        $lojtaret = Lojtar::query()
            ->with('ekipi')
            ->when($ekipiId, function ($query) use ($ekipiId) {
                $query->where('ekipi_id', $ekipiId);
            })
            ->withCount([
                'statistikat as ndeshje_luajtura' => function ($query) {
                    $query->whereHas('ndeshja', function ($q) {
                        $q->where('statusi', 'Perfunduar');
                    });
                }
            ])
            ->withSum([
                'statistikat as total_kills' => function ($query) {
                    $query->whereHas('ndeshja', fn ($q) =>
                    $q->where('statusi', 'Perfunduar'));
                }
            ], 'kills')
            ->withSum([
                'statistikat as total_aces' => function ($query) {
                    $query->whereHas('ndeshja', fn ($q) =>
                    $q->where('statusi', 'Perfunduar'));
                }
            ], 'aces')
            ->withSum([
                'statistikat as total_blocks' => function ($query) {
                    $query->whereHas('ndeshja', fn ($q) =>
                    $q->where('statusi', 'Perfunduar'));
                }
            ], 'blocks')
            ->withSum([
                'statistikat as total_digs' => function ($query) {
                    $query->whereHas('ndeshja', fn ($q) =>
                    $q->where('statusi', 'Perfunduar'));
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
            ->count();

        $mesatarjaMeELarte = $lojtaret
            ->max('mesatarja') ?? 0;

        return view('performance.index', compact(
            'lojtaret',
            'ekipet',
            'ekipiId',
            'top5',
            'totalLojtare',
            'totalPike',
            'totalNdeshje',
            'mesatarjaMeELarte'
        ));
    }
}
