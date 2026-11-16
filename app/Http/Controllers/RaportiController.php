<?php

namespace App\Http\Controllers;

use App\Models\Ekipi;
use App\Models\Lojtar;
use App\Models\Ndeshja;
use App\Models\Stervitja;
use App\Models\Prezenca;
use App\Models\StatistikaLojtarit;
use App\Models\Pagesa;
use App\Models\Transaksioni;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class RaportiController extends Controller
{
    // EKIPET E LEJUARA SIPAS ROLIT

    private function ekipet(Request $request)
    {
        $user = $request->user();

        $query = Ekipi::query();

        switch ($user->role) {

            case 'admin':
            case 'manager':
                break;

            case 'coach':

                if (!$user->trajner_id) {
                    return $query->whereRaw('1 = 0');
                }

                $query->where(
                    'trajner_id',
                    $user->trajner_id
                );

                break;

            case 'player':

                $query->where(
                    'id',
                    $user->lojtar?->ekipi_id ?? 0
                );

                break;

            default:
                abort(403);
        }

        return $query;
    }

    private function lojtaret(Request $request)
    {
        $query = Lojtar::query();

        if ($request->user()->role === 'player') {

            return $query->where(
                'id',
                $request->user()->lojtar_id ?? 0
            );
        }

        return $query->whereIn(
            'ekipi_id',
            $this->ekipet($request)->select('id')
        );
    }

    // FAQJA KRYESORE

    public function index(Request $request)
    {
        $ekipet = $this->ekipet($request)
            ->orderBy('emri')
            ->get();

        $lojtaret = $this->lojtaret($request)
            ->orderBy('emri')
            ->orderBy('mbiemri')
            ->get();

        $role = $request->user()->role;

        return view('raportet.index', compact(
            'ekipet',
            'lojtaret',
            'role'
        ));
    }

    // VALIDIMI I PERIUDHES

    private function periudha(Request $request): array
    {
        $validated = $request->validate([

            'nga' => [
                'required',
                'date_format:Y-m-d'
            ],

            'deri' => [
                'required',
                'date_format:Y-m-d',
                'after_or_equal:nga'
            ],

        ]);

        $nga = Carbon::parse(
            $validated['nga']
        )->startOfDay();

        $deri = Carbon::parse(
            $validated['deri']
        )->endOfDay();

        if ($deri->gt(
            $nga->copy()->addYear()->endOfDay()
        )) {
            throw ValidationException::withMessages([
                'deri' =>
                    'Periudha maksimale e raportit eshte nje vit.'
            ]);
        }

        return [$nga, $deri];
    }

    // RAPORTI FINANCIAR

    public function financiar(Request $request)
    {
        abort_unless(
            in_array(
                $request->user()->role,
                ['admin', 'manager'],
                true
            ),
            403
        );

        [$nga, $deri] = $this->periudha($request);

        $transaksionet = Transaksioni::whereBetween(
            'data',
            [
                $nga->toDateString(),
                $deri->toDateString()
            ]
        )->orderBy('data')->get();

        $pagat = Pagesa::with('kontrata.user')
            ->where('statusi', 'Paguar')
            ->whereBetween('data_pageses', [
                $nga->toDateString(),
                $deri->toDateString()
            ])
            ->orderBy('data_pageses')
            ->get();

        $hyrje = $transaksionet
            ->where('lloji', 'Hyrje')
            ->sum('shuma');

        $shpenzime = $transaksionet
            ->where('lloji', 'Shpenzim')
            ->sum('shuma');

        $pagatTotal = $pagat->sum('shuma');

        $bilanci = round(
            $hyrje - $shpenzime - $pagatTotal,
            2
        );

        $euro = fn ($shuma) =>
            number_format($shuma, 2) . ' EUR';

        $summary = [
            'Te hyrat' => $euro($hyrje),

            'Shpenzimet operative' =>
                $euro($shpenzime),

            'Pagat e paguara' =>
                $euro($pagatTotal),

            'Shpenzime gjithsej' =>
                $euro($shpenzime + $pagatTotal),

            'Bilanci' => $euro($bilanci),
        ];

        $sections = [

            [
                'title' => 'Transaksionet financiare',

                'headers' => [
                    'Data',
                    'Lloji',
                    'Kategoria',
                    'Pershkrimi',
                    'Shuma'
                ],

                'rows' => $transaksionet->map(
                    fn ($t) => [
                        $t->data->format('d.m.Y'),
                        $t->lloji,
                        $t->kategoria,
                        $t->pershkrimi,
                        $euro($t->shuma)
                    ]
                )->all(),
            ],

            [
                'title' => 'Pagat e paguara',

                'headers' => [
                    'Perdoruesi',
                    'Muaji',
                    'Data e pageses',
                    'Metoda',
                    'Shuma'
                ],

                'rows' => $pagat->map(
                    fn ($p) => [
                        $p->kontrata->user->name,
                        $p->muaji->format('m/Y'),
                        $p->data_pageses?->format(
                            'd.m.Y'
                        ) ?? '-',
                        $p->metoda_pageses ?? '-',
                        $euro($p->shuma)
                    ]
                )->all(),
            ],

        ];

        return $this->pdf(
            'Raporti Financiar',
            'Pasqyra e levizjeve financiare te klubit.',
            $nga,
            $deri,
            $summary,
            $sections,
            'raporti-financiar'
        );
    }

    // RAPORTI I EKIPIT

    public function ekipi(
        Request $request,
        Ekipi $ekipi
    ) {
        abort_if(
            $request->user()->role === 'player',
            403
        );

        abort_unless(
            $this->ekipet($request)
                ->whereKey($ekipi->id)
                ->exists(),
            403
        );

        [$nga, $deri] = $this->periudha($request);

        $ndeshjet = Ndeshja::where(
            'ekipi_id',
            $ekipi->id
        )->whereBetween('data_ndeshjes', [
            $nga,
            $deri
        ])->orderBy('data_ndeshjes')->get();

        $perfunduar = $ndeshjet->where(
            'statusi',
            'Perfunduar'
        );

        $fitore = $perfunduar->filter(
            fn ($n) =>
                $n->setet_tona >
                $n->setet_kundershtarit
        )->count();

        $humbje = $perfunduar->filter(
            fn ($n) =>
                $n->setet_tona <
                $n->setet_kundershtarit
        )->count();

        $winRate = $perfunduar->count()
            ? round(
                $fitore / $perfunduar->count() * 100,
                1
            )
            : 0;

        $lojtaret = Lojtar::where(
            'ekipi_id',
            $ekipi->id
        )->orderBy('emri')->get();

        $stats = StatistikaLojtarit::whereIn(
            'ndeshja_id',
            $perfunduar->pluck('id')
        )->whereIn(
            'lojtar_id',
            $lojtaret->pluck('id')
        )->get()->groupBy('lojtar_id');

        $statRows = $lojtaret->map(
            function ($lojtar) use ($stats) {

                $s = $stats->get(
                    $lojtar->id,
                    collect()
                );

                $kills = $s->sum('kills');
                $aces = $s->sum('aces');
                $blocks = $s->sum('blocks');
                $digs = $s->sum('digs');

                return [
                    $lojtar->emri . ' '
                    . $lojtar->mbiemri,
                    $s->pluck('ndeshja_id')
                        ->unique()->count(),
                    $kills,
                    $aces,
                    $blocks,
                    $digs,
                    $kills + $aces + $blocks,
                ];
            }
        )->sortByDesc(
            fn ($row) => $row[6]
        )->values()->all();

        $summary = [
            'Ekipi' => $ekipi->emri,

            'Ndeshje gjithsej' =>
                $ndeshjet->count(),

            'Ndeshje te perfunduara' =>
                $perfunduar->count(),

            'Fitore' => $fitore,

            'Humbje' => $humbje,

            'Win Rate' => $winRate . '%',
        ];

        $sections = [

            [
                'title' => 'Ndeshjet e ekipit',

                'headers' => [
                    'Data',
                    'Kundershtari',
                    'Lokacioni',
                    'Statusi',
                    'Rezultati'
                ],

                'rows' => $ndeshjet->map(
                    fn ($n) => [
                        Carbon::parse(
                            $n->data_ndeshjes
                        )->format('d.m.Y H:i'),

                        $n->kundershtari,

                        $n->lokacioni ?? '-',

                        $n->statusi,

                        $n->statusi === 'Perfunduar'
                            ? $n->setet_tona . ':'
                            . $n->setet_kundershtarit
                            : '-'
                    ]
                )->all(),
            ],

            [
                'title' => 'Statistikat e lojtareve',

                'headers' => [
                    'Volejbollistja',
                    'Ndeshje me statistika',
                    'Kills',
                    'Aces',
                    'Blocks',
                    'Digs',
                    'Pike'
                ],

                'rows' => $statRows,
            ],

        ];

        return $this->pdf(
            'Raporti i Ekipit',
            $ekipi->emri . ' - '
            . ($ekipi->kategoria ?? ''),
            $nga,
            $deri,
            $summary,
            $sections,
            'raporti-ekipit-' . $ekipi->id
        );
    }

    // RAPORTI INDIVIDUAL

    public function lojtari(
        Request $request,
        Lojtar $lojtar
    ) {
        abort_unless(
            $this->lojtaret($request)
                ->whereKey($lojtar->id)
                ->exists(),
            403
        );

        [$nga, $deri] = $this->periudha($request);

        $ndeshjetQuery = Ndeshja::where(
            'statusi',
            'Perfunduar'
        )->whereBetween('data_ndeshjes', [
            $nga,
            $deri
        ]);

        // Trajneri sheh vetem ndeshjet
        // e ekipeve te veta.

        if ($request->user()->role === 'coach') {

            $ndeshjetQuery->whereIn(
                'ekipi_id',
                $this->ekipet($request)->select('id')
            );
        }

        $ndeshjet = $ndeshjetQuery
            ->orderBy('data_ndeshjes')
            ->get()
            ->keyBy('id');

        $stats = StatistikaLojtarit::where(
            'lojtar_id',
            $lojtar->id
        )->whereIn(
            'ndeshja_id',
            $ndeshjet->keys()
        )->get();

        $kills = $stats->sum('kills');
        $aces = $stats->sum('aces');
        $blocks = $stats->sum('blocks');
        $digs = $stats->sum('digs');

        $piket = $kills + $aces + $blocks;

        $totalNdeshje = $stats->pluck(
            'ndeshja_id'
        )->unique()->count();

        $summary = [

            'Volejbollistja' =>
                $lojtar->emri . ' '
                . $lojtar->mbiemri,

            'Pozicioni' =>
                $lojtar->pozicioni ?? '-',

            'Ndeshje me statistika' =>
                $totalNdeshje,

            'Kills' => $kills,

            'Aces' => $aces,

            'Blocks' => $blocks,

            'Digs' => $digs,

            'Pike gjithsej' => $piket,

            'Mesatarja e pikeve' =>
                $totalNdeshje
                    ? round(
                    $piket / $totalNdeshje,
                    2
                )
                    : 0,
        ];

        $sections = [

            [
                'title' => 'Performanca sipas ndeshjeve',

                'headers' => [
                    'Data',
                    'Kundershtari',
                    'Kills',
                    'Aces',
                    'Blocks',
                    'Digs',
                    'Pike'
                ],

                'rows' => $stats->sortBy(
                    fn ($s) =>
                    $ndeshjet->get(
                        $s->ndeshja_id
                    )->data_ndeshjes
                )->map(
                    function ($s) use ($ndeshjet) {

                        $n = $ndeshjet->get(
                            $s->ndeshja_id
                        );

                        return [

                            Carbon::parse(
                                $n->data_ndeshjes
                            )->format('d.m.Y'),

                            $n->kundershtari,

                            $s->kills,

                            $s->aces,

                            $s->blocks,

                            $s->digs,

                            $s->kills
                            + $s->aces
                            + $s->blocks,
                        ];
                    }
                )->values()->all(),
            ],

        ];

        return $this->pdf(
            'Raporti Individual',
            $lojtar->emri . ' ' . $lojtar->mbiemri,
            $nga,
            $deri,
            $summary,
            $sections,
            'raporti-lojtarit-' . $lojtar->id
        );
    }

    // RAPORTI I PREZENCES

    public function prezenca(Request $request)
    {
        [$nga, $deri] = $this->periudha($request);

        $validated = $request->validate([
            'ekipi_id' => [
                'nullable',
                'integer'
            ],
        ]);

        $user = $request->user();

        $ekipetIds = $this->ekipet($request)
            ->pluck('id');

        $ekipiId = $validated['ekipi_id'] ?? null;

        if ($ekipiId) {

            abort_unless(
                $ekipetIds->contains($ekipiId),
                403
            );

            $ekipetIds = collect([$ekipiId]);
        }

        $stervitjetQuery = Stervitja::where(
            'statusi',
            'Perfunduar'
        )->whereBetween('data', [
            $nga->toDateString(),
            $deri->toDateString()
        ]);

        if ($user->role !== 'player' || $ekipiId) {

            $stervitjetQuery->whereIn(
                'ekipi_id',
                $ekipetIds
            );
        }

        $stervitjet = $stervitjetQuery
            ->get()
            ->keyBy('id');

        $lojtaret = $this->lojtaret($request)
            ->when(
                $ekipiId,
                fn ($q) => $q->where(
                    'ekipi_id',
                    $ekipiId
                )
            )
            ->get()
            ->keyBy('id');

        $prezencat = Prezenca::whereIn(
            'stervitja_id',
            $stervitjet->keys()
        )->whereIn(
            'lojtar_id',
            $lojtaret->keys()
        )->get();

        $total = $prezencat->count();

        $prezent = $prezencat->where(
            'statusi',
            'Prezente'
        )->count();

        $mungon = $prezencat->where(
            'statusi',
            'Mungon'
        )->count();

        $vonese = $prezencat->where(
            'statusi',
            'Me vonese'
        )->count();

        $arsyetuar = $prezencat->where(
            'statusi',
            'E arsyetuar'
        )->count();

        $perqindja = $total
            ? round(
                ($prezent + $vonese) / $total * 100,
                1
            )
            : 0;

        $summary = [

            'Regjistrime te prezences' => $total,

            'Prezente' => $prezent,

            'Mungesa' => $mungon,

            'Me vonese' => $vonese,

            'Te arsyetuara' => $arsyetuar,

            'Perqindja e pjesemarrjes' =>
                $perqindja . '%',
        ];

        $sections = [

            [
                'title' => 'Historiku i prezences',

                'headers' => [
                    'Data',
                    'Volejbollistja',
                    'Palestra',
                    'Statusi'
                ],

                'rows' => $prezencat->sortBy(
                    fn ($p) =>
                    $stervitjet->get(
                        $p->stervitja_id
                    )->data
                )->map(
                    function ($p) use (
                        $lojtaret,
                        $stervitjet
                    ) {

                        $s = $stervitjet->get(
                            $p->stervitja_id
                        );

                        $l = $lojtaret->get(
                            $p->lojtar_id
                        );

                        return [

                            Carbon::parse(
                                $s->data
                            )->format('d.m.Y'),

                            $l->emri . ' '
                            . $l->mbiemri,

                            $s->palestra ?? '-',

                            $p->statusi,

                        ];
                    }
                )->values()->all(),
            ],

        ];

        return $this->pdf(
            'Raporti i Prezences',
            'Pjesemarrja ne stervitjet e perfunduara.',
            $nga,
            $deri,
            $summary,
            $sections,
            'raporti-prezences'
        );
    }

    // GJENERIMI I PDF

    private function pdf(
        string $title,
        string $subtitle,
        Carbon $nga,
        Carbon $deri,
        array $summary,
        array $sections,
        string $filename
    ) {

        $logoPath = public_path(
            'images/logo.png'
        );

        $logo = is_file($logoPath)
            ? 'data:image/png;base64,'
            . base64_encode(
                file_get_contents($logoPath)
            )
            : null;

        $pdf = Pdf::loadView(
            'raportet.pdf',
            compact(
                'title',
                'subtitle',
                'nga',
                'deri',
                'summary',
                'sections',
                'logo'
            )
        )->setPaper('a4', 'portrait');

        $filename = Str::slug($filename)
            . '-' . now()->format('Y-m-d')
            . '.pdf';

        return $pdf->download($filename);
    }
}
