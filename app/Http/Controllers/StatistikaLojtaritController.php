<?php

namespace App\Http\Controllers;

use App\Models\Ndeshja;
use App\Models\Lojtar;
use App\Models\StatistikaLojtarit;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StatistikaLojtaritController extends Controller
{
    public function create(Ndeshja $ndeshja)
    {
        $ndeshja->load('ekipi');

        $lojtaret = Lojtar::where(
            'ekipi_id',
            $ndeshja->ekipi_id
        )->orderBy('numriFanelles')->get();

        $statistikat = $ndeshja->statistikat()
            ->get()
            ->keyBy('lojtar_id');

        return view('statistikat-lojtareve.create', compact(
            'ndeshja',
            'lojtaret',
            'statistikat'
        ));
    }

    public function store(Request $request, Ndeshja $ndeshja)
    {
        if ($ndeshja->statusi !== 'Perfunduar') {
            throw ValidationException::withMessages([
                'ndeshja' => 'Ndeshja duhet te jete e perfunduar.'
            ]);
        }

        $validated = $request->validate([
            'lojtar_id' => 'required|integer|exists:lojtar,id',
            'kills' => 'required|integer|between:0,999',
            'aces' => 'required|integer|between:0,999',
            'blocks' => 'required|integer|between:0,999',
            'digs' => 'required|integer|between:0,999',
        ]);

        $lojtar = Lojtar::findOrFail($validated['lojtar_id']);

        if ((int) $lojtar->ekipi_id !== (int) $ndeshja->ekipi_id) {
            throw ValidationException::withMessages([
                'lojtar_id' => 'Volejbollistja nuk i perket ketij ekipi.'
            ]);
        }

        StatistikaLojtarit::updateOrCreate(
            [
                'ndeshja_id' => $ndeshja->id,
                'lojtar_id' => $lojtar->id,
            ],
            [
                'kills' => $validated['kills'],
                'aces' => $validated['aces'],
                'blocks' => $validated['blocks'],
                'digs' => $validated['digs'],
            ]
        );

        return redirect()
            ->route('ndeshjet.show', $ndeshja)
            ->with('success', 'Statistikat u ruajten me sukses!');
    }

    public function destroy(
        Ndeshja $ndeshja,
        StatistikaLojtarit $statistika
    ) {
        abort_unless(
            $statistika->ndeshja_id === $ndeshja->id,
            404
        );

        $statistika->delete();

        return redirect()
            ->route('ndeshjet.show', $ndeshja)
            ->with('success', 'Statistikat u fshine!');
    }
}
