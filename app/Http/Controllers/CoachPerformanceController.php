<?php

namespace App\Http\Controllers;

use App\Models\Ekipi;
use App\Models\Lojtar;
use App\Models\Ndeshja;
use App\Models\Sezoni;
use App\Models\StatistikaLojtarit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CoachPerformanceController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        abort_unless($user->role === 'coach', 403);

        $trajner = $user->trajner;

        abort_unless(
            $trajner,
            403,
            'Profili i trajnerit nuk eshte lidhur.'
        );

        // Vetem ekipet e trajnerit

        $ekipet = Ekipi::where(
            'trajner_id',
            $trajner->id
        )->orderBy('emri')->get();

        $ekipetIds = $ekipet->pluck('id');

        $validated = $request->validate([
            'ekipi_id' => [
                'nullable',
                'integer',
                Rule::in($ekipetIds->all()),
            ],

            'sezoni_id' => [
                'nullable',
                'integer',
                Rule::exists(
                    (new Sezoni())->getTable(),
                    'id'
                ),
            ],
        ]);

        $ekipiId = $validated['ekipi_id'] ?? null;

        $sezoniId = $validated['sezoni_id'] ?? null;

        $sezonet = Sezoni::orderByDesc(
            'id'
        )->get();

        // Ndeshjet e perfunduara te ekipeve te tij

        $ndeshjet = Ndeshja::whereIn(
            'ekipi_id',
            $ekipetIds
        )
            ->where('statusi', 'Perfunduar')
            ->when(
                $ekipiId,
                fn($query) => $query->where(
                    'ekipi_id',
                    $ekipiId
                )
            )
            ->when(
                $sezoniId,
                fn($query) => $query->where(
                    'sezoni_id',
                    $sezoniId
                )
            )
            ->get();

        $ndeshjetIds = $ndeshjet->pluck('id');

        // Volejbollistet e ekipeve te trajnerit

        $lojtaret = Lojtar::whereIn(
            'ekipi_id',
            $ekipetIds
        )
            ->when(
                $ekipiId,
                fn($query) => $query->where(
                    'ekipi_id',
                    $ekipiId
                )
            )
            ->orderBy('emri')
            ->get();

        // Statistikat per ndeshjet e lejuara

        $statistikat = StatistikaLojtarit::whereIn(
            'ndeshja_id',
            $ndeshjetIds
        )
            ->whereIn(
                'lojtar_id',
                $lojtaret->pluck('id')
            )
            ->get();

        // Kontroll shtese:
        // Lojtarja duhet t'i takoje ekipit te ndeshjes

        $ndeshjetMap = $ndeshjet->keyBy('id');

        $lojtaretMap = $lojtaret->keyBy('id');

        $statistikat = $statistikat->filter(
            function ($statistika) use (
                $ndeshjetMap,
                $lojtaretMap
            ) {

                $ndeshja = $ndeshjetMap->get(
                    $statistika->ndeshja_id
                );

                $lojtar = $lojtaretMap->get(
                    $statistika->lojtar_id
                );

                return $ndeshja
                    && $lojtar
                    && (int) $ndeshja->ekipi_id
                    === (int) $lojtar->ekipi_id;

            }
        );

        $statistikatByPlayer = $statistikat
            ->groupBy('lojtar_id');

        // Llogaritja e performances

        $performance = $lojtaret->map(
            function ($lojtar) use (
                $statistikatByPlayer,
                $ekipet
            ) {

                $stat = $statistikatByPlayer->get(
                    $lojtar->id,
                    collect()
                );

                $kills = (int) $stat->sum('kills');

                $aces = (int) $stat->sum('aces');

                $blocks = (int) $stat->sum('blocks');

                $digs = (int) $stat->sum('digs');

                $piket = $kills + $aces + $blocks;

                $ndeshje = $stat
                    ->pluck('ndeshja_id')
                    ->unique()
                    ->count();

                return [

                    'id' => $lojtar->id,

                    'emri' => $lojtar->emri,

                    'mbiemri' => $lojtar->mbiemri,

                    'pozicioni' => $lojtar->pozicioni,

                    'ekipi' => $ekipet
                            ->firstWhere(
                                'id',
                                $lojtar->ekipi_id
                            )?->emri ?? '-',

                    'ndeshje' => $ndeshje,

                    'kills' => $kills,

                    'aces' => $aces,

                    'blocks' => $blocks,

                    'digs' => $digs,

                    'piket' => $piket,

                    'mesatarja' => $ndeshje > 0
                        ? round($piket / $ndeshje, 1)
                        : 0,

                ];
            }
        )
            ->sortByDesc('piket')
            ->values();

        $totalPike = $performance->sum('piket');

        $totalKills = $performance->sum('kills');

        $totalAces = $performance->sum('aces');

        $totalBlocks = $performance->sum('blocks');

        $totalDigs = $performance->sum('digs');

        $totalNdeshje = $ndeshjet->count();

        $totalLojtare = $lojtaret->count();

        $topPlayer = $performance
            ->where('ndeshje', '>', 0)
            ->first();

        return view('coach.performance', compact(
            'ekipet',
            'sezonet',
            'ekipiId',
            'sezoniId',
            'performance',
            'totalPike',
            'totalKills',
            'totalAces',
            'totalBlocks',
            'totalDigs',
            'totalNdeshje',
            'totalLojtare',
            'topPlayer'
        ));
    }
}
