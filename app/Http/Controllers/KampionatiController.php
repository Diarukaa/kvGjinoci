<?php

namespace App\Http\Controllers;

use App\Models\Kampionati;
use App\Models\Klubi;
use App\Models\Sezoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class KampionatiController extends Controller
{
    public function index()
    {
        $kampionatet = Kampionati::with([
            'sezoni',
            'klubet'
        ])->withCount('klubet')
            ->latest()
            ->get();

        $sezonet = Sezoni::orderByDesc(
            'data_fillimit'
        )->get();

        $klubet = Klubi::orderBy('emri')->get();

        return view('kampionatet.index', compact(
            'kampionatet',
            'sezonet',
            'klubet'
        ));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'emri' => [
                'required',
                'string',
                'max:255',
                Rule::unique('kampionatet', 'emri')
                    ->where('sezoni_id', $request->sezoni_id)
                    ->where('kategoria', $request->kategoria),
            ],
            'sezoni_id' => 'required|exists:sezonet,id',
            'kategoria' => 'required|in:Senior,U18,U16,U14',
            'klubet' => 'nullable|array',
            'klubet.*' => 'integer|distinct|exists:klubet,id',
        ]);

        DB::transaction(function () use ($data) {
            $kampionati = Kampionati::create([
                'emri' => $data['emri'],
                'sezoni_id' => $data['sezoni_id'],
                'kategoria' => $data['kategoria'],
            ]);

            $kampionati->klubet()->sync(
                $data['klubet'] ?? []
            );
        });

        return redirect()->route('kampionatet.index')
            ->with('success', 'Kampionati u krijua!');
    }

    public function show(Kampionati $kampionati)
    {
        $kampionati->load(['sezoni', 'klubet']);

        return view(
            'kampionatet.show',
            compact('kampionati')
        );
    }

    public function update(
        Request $request,
        Kampionati $kampionati
    ) {
        $data = $request->validate([
            'emri' => [
                'required',
                'string',
                'max:255',
                Rule::unique('kampionatet', 'emri')
                    ->where('sezoni_id', $request->sezoni_id)
                    ->where('kategoria', $request->kategoria)
                    ->ignore($kampionati->id),
            ],
            'sezoni_id' => 'required|exists:sezonet,id',
            'kategoria' => 'required|in:Senior,U18,U16,U14',
            'klubet' => 'nullable|array',
            'klubet.*' => 'integer|distinct|exists:klubet,id',
        ]);

        DB::transaction(function () use ($data, $kampionati) {
            $kampionati->update([
                'emri' => $data['emri'],
                'sezoni_id' => $data['sezoni_id'],
                'kategoria' => $data['kategoria'],
            ]);

            $kampionati->klubet()->sync(
                $data['klubet'] ?? []
            );
        });

        return redirect()->route('kampionatet.index')
            ->with('success', 'Kampionati u perditesua!');
    }

    public function destroy(Kampionati $kampionati)
    {
        $kampionati->delete();

        return redirect()->route('kampionatet.index')
            ->with('success', 'Kampionati u fshi!');
    }
}
