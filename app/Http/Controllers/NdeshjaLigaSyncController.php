<?php

namespace App\Http\Controllers;

use App\Models\Kampionati;
use App\Models\Klubi;
use App\Models\Ndeshja;
use App\Models\NdeshjaLiges;
use App\Services\LigaSyncService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class NdeshjaLigaSyncController extends Controller
{
    public function create(Ndeshja $ndeshja)
    {
        $ndeshja->load([
            'ekipi',
            'sezoni',
            'rezultatiLiges'
        ]);

        if ($ndeshja->statusi !== 'Perfunduar') {
            return redirect()
                ->route('ndeshjet.show', $ndeshja)
                ->withErrors([
                    'ndeshja' => 'Ndeshja duhet te perfundoje.'
                ]);
        }

        $gjinoci = Klubi::where('emri', 'KV Gjinoci')
            ->firstOrFail();

        $kampionatet = Kampionati::query()
            ->where('sezoni_id', $ndeshja->sezoni_id)
            ->where('kategoria', $ndeshja->ekipi->kategoria)
            ->whereHas('klubet', fn ($query) =>
            $query->where('klubet.id', $gjinoci->id))
            ->with('klubet')
            ->get();

        return view('ndeshjet.lidh-ligen', compact(
            'ndeshja',
            'kampionatet',
            'gjinoci'
        ));
    }

    public function store(
        Request $request,
        Ndeshja $ndeshja,
        LigaSyncService $service
    ) {
        $validated = $request->validate([
            'kampionati_id' => 'required|exists:kampionatet,id',
            'kundershtari_id' => 'required|exists:klubet,id',
        ]);

        DB::transaction(function () use (
            $validated,
            $ndeshja,
            $service
        ) {
            $ndeshja = Ndeshja::whereKey($ndeshja->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($ndeshja->rezultatiLiges()->exists()) {
                throw ValidationException::withMessages([
                    'ndeshja' => 'Ndeshja tashme eshte e lidhur me ligen.'
                ]);
            }

            $kampionati = Kampionati::findOrFail(
                $validated['kampionati_id']
            );

            $gjinoci = Klubi::where('emri', 'KV Gjinoci')
                ->firstOrFail();

            $kundershtari = Klubi::findOrFail(
                $validated['kundershtari_id']
            );

            $data = $service->teDhenat(
                $ndeshja,
                $kampionati,
                $gjinoci,
                $kundershtari
            );

            $ekzistues = $service->gjejDuplikat($data);

            if ($ekzistues) {
                if ($ekzistues->ndeshja_id !== null) {
                    throw ValidationException::withMessages([
                        'ndeshja' => 'Rezultati eshte i lidhur me nje ndeshje tjeter.'
                    ]);
                }

                if (
                    (int) $ekzistues->klubi_vendas_id !==
                    (int) $data['klubi_vendas_id'] ||
                    (int) $ekzistues->setet_vendas !==
                    (int) $data['setet_vendas'] ||
                    (int) $ekzistues->setet_mysafir !==
                    (int) $data['setet_mysafir']
                ) {
                    throw ValidationException::withMessages([
                        'ndeshja' => 'Rezultati ekzistues ne lige nuk perputhet. Kontrolloje para lidhjes.'
                    ]);
                }

                $ekzistues->update([
                    'ndeshja_id' => $ndeshja->id,
                ]);
            } else {
                NdeshjaLiges::create($data);
            }
        });

        return redirect()
            ->route('ndeshjet.show', $ndeshja)
            ->with('success', 'Ndeshja u lidh me ligen!');
    }
}
