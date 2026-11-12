<?php

namespace App\Http\Controllers;

use App\Models\Kampionati;
use App\Models\NdeshjaLiges;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class NdeshjaLigesController extends Controller
{
    public function index(Kampionati $kampionati)
    {
        $kampionati->load(['sezoni', 'klubet']);

        $ndeshjet = $kampionati->ndeshjet()
            ->with(['vendas', 'mysafir'])
            ->orderByDesc('data_ndeshjes')
            ->get();

        $klubet = $kampionati->klubet
            ->sortBy('emri');

        $renditja = [];

        foreach ($klubet as $klubi) {
            $renditja[$klubi->id] = [
                'klubi' => $klubi,
                'ndeshje' => 0,
                'fitore' => 0,
                'humbje' => 0,
                'setet_fituara' => 0,
                'setet_humbura' => 0,
                'piket' => 0,
            ];
        }

        foreach ($ndeshjet as $ndeshja) {
            $v = $ndeshja->klubi_vendas_id;
            $m = $ndeshja->klubi_mysafir_id;

            $sv = $ndeshja->setet_vendas;
            $sm = $ndeshja->setet_mysafir;

            if (!isset($renditja[$v], $renditja[$m])) {
                continue;
            }

            $renditja[$v]['ndeshje']++;
            $renditja[$m]['ndeshje']++;

            $renditja[$v]['setet_fituara'] += $sv;
            $renditja[$v]['setet_humbura'] += $sm;

            $renditja[$m]['setet_fituara'] += $sm;
            $renditja[$m]['setet_humbura'] += $sv;

            if ($sv === 3) {
                $renditja[$v]['fitore']++;
                $renditja[$m]['humbje']++;

                $renditja[$v]['piket'] += $sm === 2 ? 2 : 3;
                $renditja[$m]['piket'] += $sm === 2 ? 1 : 0;
            } else {
                $renditja[$m]['fitore']++;
                $renditja[$v]['humbje']++;

                $renditja[$m]['piket'] += $sv === 2 ? 2 : 3;
                $renditja[$v]['piket'] += $sv === 2 ? 1 : 0;
            }
        }

        $renditja = collect($renditja)
            ->map(function ($rreshti) {
                $rreshti['diferenca'] =
                    $rreshti['setet_fituara'] -
                    $rreshti['setet_humbura'];

                $rreshti['koeficienti'] =
                    $rreshti['setet_humbura'] > 0
                        ? $rreshti['setet_fituara'] /
                        $rreshti['setet_humbura']
                        : ($rreshti['setet_fituara'] > 0
                        ? INF
                        : 0);

                return $rreshti;
            })
            ->sort(function ($a, $b) {
                return ($b['fitore'] <=> $a['fitore'])
                    ?: ($b['piket'] <=> $a['piket'])
                        ?: ($b['koeficienti'] <=> $a['koeficienti'])
                            ?: strcmp(
                                $a['klubi']->emri,
                                $b['klubi']->emri
                            );
            })
            ->values();

        return view('liga.index', compact(
            'kampionati',
            'ndeshjet',
            'klubet',
            'renditja'
        ));
    }

    public function store(
        Request $request,
        Kampionati $kampionati
    ) {
        $data = $this->validimi(
            $request,
            $kampionati
        );

        $kampionati->ndeshjet()->create($data);

        return redirect()
            ->route('liga.index', $kampionati)
            ->with('success', 'Rezultati u regjistrua!');
    }

    public function update(
        Request $request,
        Kampionati $kampionati,
        NdeshjaLiges $ndeshja
    ) {
        abort_unless(
            (int) $ndeshja->kampionati_id ===
            (int) $kampionati->id,
            404
        );

        if ($ndeshja->ndeshja_id !== null) {
            return redirect()
                ->route('ndeshjet.edit', $ndeshja->ndeshja_id)
                ->withErrors([
                    'ndeshja' => 'Ky rezultat menaxhohet nga ndeshja e KV Gjinocit.'
                ]);
        }

        $data = $this->validimi(
            $request,
            $kampionati,
            $ndeshja
        );

        $ndeshja->update($data);

        return redirect()
            ->route('liga.index', $kampionati)
            ->with('success', 'Rezultati u perditesua!');
    }

    public function destroy(
        Kampionati $kampionati,
        NdeshjaLiges $ndeshja
    ) {
        abort_unless(
            (int) $ndeshja->kampionati_id ===
            (int) $kampionati->id,
            404
        );

        if ($ndeshja->ndeshja_id !== null) {
            return back()->withErrors([
                'ndeshja' => 'Ky rezultat eshte i lidhur me nje ndeshje te KV Gjinocit.'
            ]);
        }

        $ndeshja->delete();

        return redirect()
            ->route('liga.index', $kampionati)
            ->with('success', 'Rezultati u fshi!');
    }

    private function validimi(
        Request $request,
        Kampionati $kampionati,
        ?NdeshjaLiges $ndeshja = null
    ): array {
        $data = $request->validate([
            'klubi_vendas_id' => [
                'required',
                'integer',
                'exists:klubet,id',
            ],

            'klubi_mysafir_id' => [
                'required',
                'integer',
                'exists:klubet,id',
                'different:klubi_vendas_id',
            ],

            'data_ndeshjes' => [
                'required',
                'date_format:Y-m-d',
                'before_or_equal:today',
            ],

            'setet_vendas' => [
                'required',
                'integer',
                'between:0,3',
            ],

            'setet_mysafir' => [
                'required',
                'integer',
                'between:0,3',
            ],
        ]);

        $klubet = $kampionati->klubet()
            ->pluck('klubet.id')
            ->map(fn ($id) => (int) $id);

        if (
            !$klubet->contains((int) $data['klubi_vendas_id']) ||
            !$klubet->contains((int) $data['klubi_mysafir_id'])
        ) {
            throw ValidationException::withMessages([
                'klubet' => 'Te dy klubet duhet te jene ne kampionat.'
            ]);
        }

        $sv = (int) $data['setet_vendas'];
        $sm = (int) $data['setet_mysafir'];

        if (max($sv, $sm) !== 3 || min($sv, $sm) === 3) {
            throw ValidationException::withMessages([
                'rezultati' => 'Rezultati duhet te jete 3-0, 3-1 ose 3-2.'
            ]);
        }

        $sezoni = $kampionati->sezoni;

        if (
            $data['data_ndeshjes'] <
            $sezoni->data_fillimit->format('Y-m-d') ||
            $data['data_ndeshjes'] >
            $sezoni->data_mbarimit->format('Y-m-d')
        ) {
            throw ValidationException::withMessages([
                'data_ndeshjes' => 'Data duhet te jete brenda sezonit.'
            ]);
        }

        $duplikat = NdeshjaLiges::query()
            ->where('kampionati_id', $kampionati->id)
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
            ->when($ndeshja, function ($query) use ($ndeshja) {
                $query->where('id', '!=', $ndeshja->id);
            })
            ->exists();

        if ($duplikat) {
            throw ValidationException::withMessages([
                'ndeshja' => 'Kjo ndeshje eshte regjistruar tashme.'
            ]);
        }

        return $data;
    }
}
