<?php

namespace App\Http\Controllers;

use App\Models\Ekipi;
use App\Models\Ndeshja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class NdeshjaController extends Controller
{
    public function index()
    {
        $ndeshjet = Ndeshja::with('ekipi')
            ->orderBy('data_ndeshjes', 'desc')
            ->paginate(10);

        return view('ndeshjet.index', compact('ndeshjet'));
    }

    public function create()
    {
        $ekipet = Ekipi::orderBy('emri')->get();

        return view('ndeshjet.create', compact('ekipet'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateNdeshja($request);

        DB::transaction(function () use ($validated) {
            $data = $validated;
            $setet = $data['setet'] ?? [];
            unset($data['setet']);

            $data['setet_tona'] = null;
            $data['setet_kundershtarit'] = null;

            if ($data['statusi'] === 'Perfunduar') {
                [$tona, $kundershtarit] =
                    $this->llogaritSetet($setet);

                $data['setet_tona'] = $tona;
                $data['setet_kundershtarit'] = $kundershtarit;
            }

            $ndeshja = Ndeshja::create($data);

            if ($data['statusi'] === 'Perfunduar') {
                $ndeshja->setet()->createMany($setet);
            }
        });

        return redirect()->route('ndeshjet.index')
            ->with('success', 'Ndeshja u regjistrua!');
    }

    public function show(Ndeshja $ndeshja)
    {
        $ndeshja->load(['ekipi', 'setet']);

        return view('ndeshjet.show', compact('ndeshja'));
    }

    public function edit(Ndeshja $ndeshja)
    {
        $ekipet = Ekipi::orderBy('emri')->get();
        $ndeshja->load('setet');

        return view('ndeshjet.edit', compact(
            'ndeshja',
            'ekipet'
        ));
    }

    public function update(Request $request, Ndeshja $ndeshja)
    {
        $validated = $this->validateNdeshja($request);

        DB::transaction(function () use ($validated, $ndeshja) {
            $data = $validated;
            $setet = $data['setet'] ?? [];
            unset($data['setet']);

            $data['setet_tona'] = null;
            $data['setet_kundershtarit'] = null;

            if ($data['statusi'] === 'Perfunduar') {
                [$tona, $kundershtarit] =
                    $this->llogaritSetet($setet);

                $data['setet_tona'] = $tona;
                $data['setet_kundershtarit'] = $kundershtarit;
            }

            $ndeshja->update($data);
            $ndeshja->setet()->delete();

            if ($data['statusi'] === 'Perfunduar') {
                $ndeshja->setet()->createMany($setet);
            }
        });

        return redirect()->route('ndeshjet.index')
            ->with('success', 'Ndeshja u perditesua!');
    }

    public function destroy(Ndeshja $ndeshja)
    {
        $ndeshja->delete();

        return redirect()->route('ndeshjet.index')
            ->with('success', 'Ndeshja u fshi!');
    }

    private function validateNdeshja(Request $request): array
    {
        $data = $request->validate([
            'ekipi_id' => 'required|exists:ekipet,id',
            'kundershtari' => 'required|string|max:255',
            'data_ndeshjes' => 'required|date',
            'palestra' => 'required|string|max:255',
            'lokacioni' => [
                'required',
                Rule::in(['Vendas', 'Mysafir'])
            ],
            'statusi' => [
                'required',
                Rule::in(['Planifikuar', 'Perfunduar'])
            ],
            'setet' => 'exclude_unless:statusi,Perfunduar|required_if:statusi,Perfunduar|array',
            'setet.*.numri_setit' => 'required|integer|between:1,5',
            'setet.*.piket_tona' => 'required|integer|between:0,999',
            'setet.*.piket_kundershtarit' => 'required|integer|between:0,999',
        ]);

        if ($data['statusi'] === 'Perfunduar') {
            $setet = $data['setet'] ?? [];

            if (count($setet) < 3 || count($setet) > 5) {
                throw ValidationException::withMessages([
                    'setet' => 'Ndeshja duhet te kete 3 deri 5 sete.'
                ]);
            }


            $numrat = array_map(
                'intval',
                array_column($setet, 'numri_setit')
            );

            sort($numrat, SORT_NUMERIC);

            if ($numrat !== range(1, count($setet))) {
                throw ValidationException::withMessages([
                    'setet' => 'Numrat e seteve duhet te jene radhazi.'
                ]);
            }


            $fitoretTona = 0;
            $fitoretKundershtarit = 0;

            foreach ($setet as $i => $seti) {
                $tona = (int) $seti['piket_tona'];
                $kundershtarit = (int) $seti['piket_kundershtarit'];
                $target = $i === 4 ? 15 : 25;

                $fituesi = max($tona, $kundershtarit);
                $humbesi = min($tona, $kundershtarit);

                if ($fituesi < $target ||
                    $fituesi - $humbesi < 2 ||
                    ($fituesi > $target &&
                        $fituesi - $humbesi !== 2)) {
                    throw ValidationException::withMessages([
                        'setet' => 'Rezultat i pavlefshem ne setin ' . ($i + 1)
                    ]);
                }

                if ($tona > $kundershtarit) {
                    $fitoretTona++;
                } else {
                    $fitoretKundershtarit++;
                }

                if (($fitoretTona === 3 ||
                        $fitoretKundershtarit === 3) &&
                    $i !== count($setet) - 1) {
                    throw ValidationException::withMessages([
                        'setet' => 'Ndeshja mbaron kur nje ekip fiton 3 sete.'
                    ]);
                }
            }

            if (max($fitoretTona, $fitoretKundershtarit) !== 3) {
                throw ValidationException::withMessages([
                    'setet' => 'Ndeshja duhet te perfundoje me 3 sete te fituara.'
                ]);
            }
        }

        return $data;
    }

    private function llogaritSetet(array $setet): array
    {
        $tona = 0;
        $kundershtarit = 0;

        foreach ($setet as $seti) {
            if ($seti['piket_tona'] > $seti['piket_kundershtarit']) {
                $tona++;
            } else {
                $kundershtarit++;
            }
        }

        return [$tona, $kundershtarit];
    }
}
