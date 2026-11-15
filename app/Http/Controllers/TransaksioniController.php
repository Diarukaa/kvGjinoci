<?php

namespace App\Http\Controllers;

use App\Models\Transaksioni;
use App\Models\Pagesa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TransaksioniController extends Controller
{
    private function kontrolloLejen(Request $request): void
    {
        abort_unless(
            in_array(
                $request->user()->role,
                ['admin', 'manager'],
                true
            ),
            403
        );
    }

    public function index(Request $request)
    {
        $this->kontrolloLejen($request);

        $validated = $request->validate([
            'muaji' => ['nullable', 'integer', 'between:1,12'],
            'viti' => ['nullable', 'integer', 'between:2000,2100'],
        ]);

        $muaji = $validated['muaji'] ?? now()->month;
        $viti = $validated['viti'] ?? now()->year;

        $fillimi = Carbon::create(
            $viti, $muaji, 1
        )->startOfMonth();

        $fundi = $fillimi->copy()->endOfMonth();

        $query = Transaksioni::whereBetween('data', [
            $fillimi->toDateString(),
            $fundi->toDateString()
        ]);

        $totalHyrje = (clone $query)
            ->where('lloji', 'Hyrje')
            ->sum('shuma');

        $totalShpenzime = (clone $query)
            ->where('lloji', 'Shpenzim')
            ->sum('shuma');

        // Pagat e paguara gjate muajit

        $pagatQuery = Pagesa::where('statusi', 'Paguar')
            ->whereBetween('data_pageses', [
                $fillimi->toDateString(),
                $fundi->toDateString()
            ]);

        $totalPaga = (clone $pagatQuery)->sum('shuma');

        // Llogaritjet ne cent per saktesi financiare

        $hyrjeCent = (int) round($totalHyrje * 100);
        $shpenzimeCent = (int) round($totalShpenzime * 100);
        $pagaCent = (int) round($totalPaga * 100);

        $shpenzimeGjithsej =
            ($shpenzimeCent + $pagaCent) / 100;

        $bilanci =
            ($hyrjeCent - $shpenzimeCent - $pagaCent) / 100;

        $totalPapaguar = Pagesa::where(
            'statusi',
            'Pa paguar'
        )->sum('shuma');

        $transaksionet = $query
            ->with('user')
            ->orderByDesc('data')
            ->orderByDesc('id')
            ->paginate(15)
            ->withQueryString();

        $pagat = $pagatQuery
            ->with('kontrata.user')
            ->orderByDesc('data_pageses')
            ->get();

        // Grafikat per 12 muajt e vitit

        $transaksionetVjetore = Transaksioni::whereYear(
            'data',
            $viti
        )->get()->groupBy(
            fn ($t) => $t->data->month
        );

        $pagatVjetore = Pagesa::where('statusi', 'Paguar')
            ->whereYear('data_pageses', $viti)
            ->get()
            ->groupBy(
                fn ($p) => $p->data_pageses->month
            );

        $emratMuajve = [
            1 => 'Jan',
            2 => 'Shk',
            3 => 'Mar',
            4 => 'Pri',
            5 => 'Maj',
            6 => 'Qer',
            7 => 'Kor',
            8 => 'Gus',
            9 => 'Sht',
            10 => 'Tet',
            11 => 'Nen',
            12 => 'Dhj',
        ];

        $grafiku = [];

        foreach ($emratMuajve as $numri => $emri) {

            $trans = $transaksionetVjetore->get(
                $numri,
                collect()
            );

            $pagatMuajit = $pagatVjetore->get(
                $numri,
                collect()
            )->sum('shuma');

            $hyrje = $trans
                ->where('lloji', 'Hyrje')
                ->sum('shuma');

            $shpenzime = $trans
                ->where('lloji', 'Shpenzim')
                ->sum('shuma');

            $grafiku[] = [
                'muaji' => $emri,
                'hyrje' => round($hyrje, 2),
                'shpenzime' => round(
                    $shpenzime + $pagatMuajit,
                    2
                ),
            ];
        }

        $kategorite = Transaksioni::KATEGORITE;

        return view('financat.transaksionet', compact(
            'muaji',
            'viti',
            'totalHyrje',
            'totalShpenzime',
            'totalPaga',
            'totalPapaguar',
            'shpenzimeGjithsej',
            'bilanci',
            'transaksionet',
            'pagat',
            'grafiku',
            'emratMuajve',
            'kategorite'
        ));
    }

    public function store(Request $request)
    {
        $this->kontrolloLejen($request);

        $validated = $this->validimi($request);

        Transaksioni::create([
            ...$validated,
            'user_id' => $request->user()->id,
        ]);

        return redirect()
            ->route('financat.transaksionet.index', [
                'muaji' => Carbon::parse(
                    $validated['data']
                )->month,

                'viti' => Carbon::parse(
                    $validated['data']
                )->year,
            ])
            ->with(
                'success',
                'Transaksioni u regjistrua me sukses.'
            );
    }

    public function edit(
        Request $request,
        Transaksioni $transaksioni
    )
    {
        $this->kontrolloLejen($request);

        $kategorite = Transaksioni::KATEGORITE;

        return view(
            'financat.transaksioni-edit',
            compact('transaksioni', 'kategorite')
        );
    }

    public function update(
        Request $request,
        Transaksioni $transaksioni
    )
    {
        $this->kontrolloLejen($request);

        $validated = $this->validimi($request);

        $transaksioni->update($validated);

        return redirect()
            ->route('financat.transaksionet.index', [
                'muaji' => $transaksioni->data->month,
                'viti' => $transaksioni->data->year,
            ])
            ->with(
                'success',
                'Transaksioni u perditesua me sukses.'
            );
    }

    public function destroy(
        Request $request,
        Transaksioni $transaksioni
    )
    {
        $this->kontrolloLejen($request);

        $muaji = $transaksioni->data->month;
        $viti = $transaksioni->data->year;

        $transaksioni->delete();

        return redirect()
            ->route('financat.transaksionet.index', [
                'muaji' => $muaji,
                'viti' => $viti,
            ])
            ->with(
                'success',
                'Transaksioni u fshi me sukses.'
            );
    }

    private function validimi(Request $request): array
    {
        $lloji = $request->input('lloji');

        $kategorite = is_string($lloji)
            ? (Transaksioni::KATEGORITE[$lloji] ?? [])
            : [];

        return $request->validate([
            'lloji' => [
                'required',
                Rule::in(['Hyrje', 'Shpenzim']),
            ],

            'kategoria' => [
                'required',
                Rule::in($kategorite),
            ],

            'pershkrimi' => [
                'required',
                'string',
                'max:255',
            ],

            'shuma' => [
                'required',
                'numeric',
                'decimal:0,2',
                'min:0.01',
                'max:9999999999.99',
            ],

            'data' => [
                'required',
                'date_format:Y-m-d',
                'before_or_equal:today',
                'after_or_equal:2000-01-01',
            ],

            'metoda_pageses' => [
                'required',
                Rule::in(['Banke', 'Cash']),
            ],

            'referenca' => [
                'nullable',
                'string',
                'max:255',
            ],

            'shenime' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ]);
    }
}
