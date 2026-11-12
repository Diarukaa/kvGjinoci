<?php

namespace App\Http\Controllers;

use App\Models\Stervitja;
use App\Models\Ekipi;
use App\Models\Trajner;
use App\Models\Sezoni;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StervitjaController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'ekipi_id' => 'nullable|exists:ekipet,id',
            'statusi' => 'nullable|in:Planifikuar,Perfunduar,Anuluar',
        ]);

        $ekipiId = $validated['ekipi_id'] ?? null;
        $statusi = $validated['statusi'] ?? null;

        $ekipet = Ekipi::orderBy('emri')->get();

        $stervitjet = Stervitja::with([
            'ekipi',
            'trajner',
            'sezoni'
        ])
            ->when($ekipiId, fn ($q) =>
            $q->where('ekipi_id', $ekipiId))
            ->when($statusi, fn ($q) =>
            $q->where('statusi', $statusi))
            ->orderBy('data')
            ->orderBy('ora_fillimit')
            ->paginate(10)
            ->withQueryString();

        $totalPlanifikuara = Stervitja::where(
            'statusi', 'Planifikuar'
        )->count();

        $totalPerfunduar = Stervitja::where(
            'statusi', 'Perfunduar'
        )->count();

        return view('stervitjet.index', compact(
            'stervitjet',
            'ekipet',
            'ekipiId',
            'statusi',
            'totalPlanifikuara',
            'totalPerfunduar'
        ));
    }

    public function create()
    {
        $ekipet = Ekipi::orderBy('emri')->get();
        $trajneret = Trajner::orderBy('emri')->get();
        $sezonet = Sezoni::orderByDesc('data_fillimit')->get();

        return view('stervitjet.create', compact(
            'ekipet',
            'trajneret',
            'sezonet'
        ));
    }

    public function store(Request $request)
    {
        $validated = $this->validimi($request);

        Stervitja::create($validated);

        return redirect()
            ->route('stervitjet.index')
            ->with('success', 'Stervitja u regjistrua!');
    }

    public function show(Stervitja $stervitja)
    {
        $stervitja->load([
            'ekipi',
            'trajner',
            'sezoni'
        ]);

        return view(
            'stervitjet.show',
            compact('stervitja')
        );
    }

    public function edit(Stervitja $stervitja)
    {
        $ekipet = Ekipi::orderBy('emri')->get();
        $trajneret = Trajner::orderBy('emri')->get();
        $sezonet = Sezoni::orderByDesc('data_fillimit')->get();

        return view('stervitjet.edit', compact(
            'stervitja',
            'ekipet',
            'trajneret',
            'sezonet'
        ));
    }

    public function update(
        Request $request,
        Stervitja $stervitja
    ) {
        $validated = $this->validimi(
            $request,
            $stervitja
        );

        $stervitja->update($validated);

        return redirect()
            ->route('stervitjet.index')
            ->with('success', 'Stervitja u perditesua!');
    }

    public function destroy(Stervitja $stervitja)
    {
        $stervitja->delete();

        return redirect()
            ->route('stervitjet.index')
            ->with('success', 'Stervitja u fshi!');
    }

    private function validimi(
        Request $request,
        ?Stervitja $stervitja = null
    ): array {
        $data = $request->validate([
            'ekipi_id' => 'required|exists:ekipet,id',
            'trajner_id' => 'nullable|exists:trajner,id',
            'sezoni_id' => 'nullable|exists:sezonet,id',

            'data' => 'required|date_format:Y-m-d',

            'ora_fillimit' => 'required|date_format:H:i',

            'ora_mbarimit' => [
                'required',
                'date_format:H:i',
                'after:ora_fillimit',
            ],

            'palestra' => 'required|string|max:255',

            'lloji' => 'required|in:Fizike,Teknike,Taktike,Miqesore,Rikuperim',

            'statusi' => 'required|in:Planifikuar,Perfunduar,Anuluar',

            'pershkrimi' => 'nullable|string|max:2000',
        ]);

        // Kontrollo daten e sezonit
        if (!empty($data['sezoni_id'])) {
            $sezoni = Sezoni::findOrFail(
                $data['sezoni_id']
            );

            if (
                $data['data'] <
                $sezoni->data_fillimit->format('Y-m-d') ||
                $data['data'] >
                $sezoni->data_mbarimit->format('Y-m-d')
            ) {
                throw ValidationException::withMessages([
                    'data' => 'Data duhet te jete brenda sezonit.'
                ]);
            }
        }

        // Kontrollo konfliktet ne orar
        if ($data['statusi'] !== 'Anuluar') {
            $konflikt = Stervitja::query()
                ->whereDate('data', $data['data'])
                ->where('statusi', '!=', 'Anuluar')

                ->where(function ($query) use ($data) {
                    $query->where(
                        'ekipi_id',
                        $data['ekipi_id']
                    )->orWhere(
                        'palestra',
                        $data['palestra']
                    );

                    if (!empty($data['trajner_id'])) {
                        $query->orWhere(
                            'trajner_id',
                            $data['trajner_id']
                        );
                    }
                })

                ->where(
                    'ora_fillimit',
                    '<',
                    $data['ora_mbarimit']
                )

                ->where(
                    'ora_mbarimit',
                    '>',
                    $data['ora_fillimit']
                )

                ->when($stervitja, fn ($q) =>
                $q->where('id', '!=', $stervitja->id))

                ->exists();

            if ($konflikt) {
                throw ValidationException::withMessages([
                    'ora_fillimit' =>
                        'Ekipi, trajneri ose palestra eshte e zene ne kete orar.'
                ]);
            }
        }

        return $data;
    }
}
