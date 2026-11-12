<?php

namespace App\Services;

use App\Models\Kampionati;
use App\Models\Klubi;
use App\Models\Ndeshja;
use App\Models\NdeshjaLiges;
use Illuminate\Validation\ValidationException;

class LigaSyncService
{
    public function teDhenat(
        Ndeshja $ndeshja,
        Kampionati $kampionati,
        Klubi $gjinoci,
        Klubi $kundershtari
    ): array {
        if ($ndeshja->statusi !== 'Perfunduar') {
            throw ValidationException::withMessages([
                'ndeshja' => 'Ndeshja duhet te jete e perfunduar.'
            ]);
        }

        if (
            (int) $ndeshja->sezoni_id !==
            (int) $kampionati->sezoni_id
        ) {
            throw ValidationException::withMessages([
                'sezoni' => 'Ndeshja dhe kampionati duhet te kene sezonin e njejte.'
            ]);
        }

        if ($ndeshja->ekipi->kategoria !== $kampionati->kategoria) {
            throw ValidationException::withMessages([
                'kategoria' => 'Kategoria e ekipit nuk perputhet me kampionatin.'
            ]);
        }

        if ($gjinoci->id === $kundershtari->id) {
            throw ValidationException::withMessages([
                'kundershtari' => 'Zgjedh nje klub tjeter.'
            ]);
        }

        $klubet = $kampionati->klubet()
            ->pluck('klubet.id')
            ->map(fn ($id) => (int) $id);

        if (
            !$klubet->contains((int) $gjinoci->id) ||
            !$klubet->contains((int) $kundershtari->id)
        ) {
            throw ValidationException::withMessages([
                'klubet' => 'Te dy klubet duhet te jene pjese e kampionatit.'
            ]);
        }

        $data = $ndeshja->data_ndeshjes->format('Y-m-d');

        if (
            $data < $kampionati->sezoni->data_fillimit->format('Y-m-d') ||
            $data > $kampionati->sezoni->data_mbarimit->format('Y-m-d') ||
            $data > now()->format('Y-m-d')
        ) {
            throw ValidationException::withMessages([
                'data' => 'Data e ndeshjes nuk eshte e vlefshme.'
            ]);
        }

        $vendas = $ndeshja->lokacioni === 'Vendas';

        return [
            'kampionati_id' => $kampionati->id,
            'ndeshja_id' => $ndeshja->id,

            'klubi_vendas_id' => $vendas
                ? $gjinoci->id
                : $kundershtari->id,

            'klubi_mysafir_id' => $vendas
                ? $kundershtari->id
                : $gjinoci->id,

            'data_ndeshjes' => $data,

            'setet_vendas' => $vendas
                ? $ndeshja->setet_tona
                : $ndeshja->setet_kundershtarit,

            'setet_mysafir' => $vendas
                ? $ndeshja->setet_kundershtarit
                : $ndeshja->setet_tona,
        ];
    }

    public function sinkronizo(Ndeshja $ndeshja): void
    {
        $rezultati = $ndeshja->rezultatiLiges()->first();

        if (!$rezultati) {
            return;
        }

        $gjinoci = Klubi::where('emri', 'KV Gjinoci')
            ->firstOrFail();

        $kundershtari = (int) $rezultati->klubi_vendas_id
        === (int) $gjinoci->id
            ? $rezultati->mysafir
            : $rezultati->vendas;

        $data = $this->teDhenat(
            $ndeshja,
            $rezultati->kampionati,
            $gjinoci,
            $kundershtari
        );

        if ($this->gjejDuplikat($data, $rezultati->id)) {
            throw ValidationException::withMessages([
                'ndeshja' => 'Ekziston nje rezultat tjeter per kete ndeshje ne lige.'
            ]);
        }

        $rezultati->update($data);
    }

    public function gjejDuplikat(
        array $data,
        ?int $ignoreId = null
    ): ?NdeshjaLiges {
        return NdeshjaLiges::query()
            ->where('kampionati_id', $data['kampionati_id'])
            ->whereDate('data_ndeshjes', $data['data_ndeshjes'])
            ->where(function ($query) use ($data) {
                $query->where(function ($q) use ($data) {
                    $q->where(
                        'klubi_vendas_id',
                        $data['klubi_vendas_id']
                    )->where(
                        'klubi_mysafir_id',
                        $data['klubi_mysafir_id']
                    );
                })->orWhere(function ($q) use ($data) {
                    $q->where(
                        'klubi_vendas_id',
                        $data['klubi_mysafir_id']
                    )->where(
                        'klubi_mysafir_id',
                        $data['klubi_vendas_id']
                    );
                });
            })
            ->when($ignoreId !== null, fn ($query) =>
            $query->where('id', '!=', $ignoreId))
            ->first();
    }
}
