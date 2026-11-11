<?php

namespace App\Http\Controllers;

use App\Models\Ekipi;
use App\Models\Trajner;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EkipiController extends Controller
{
    public function index()
    {
        $ekipet = Ekipi::with('trajner')
            ->withCount('lojtaret')
            ->orderBy('emri')
            ->paginate(10);

        return view('ekipet.index', compact('ekipet'));
    }

    public function create()
    {
        $trajneret = Trajner::orderBy('emri')->get();

        return view('ekipet.create', compact('trajneret'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'emri' => 'required|string|max:255|unique:ekipet,emri',
            'kategoria' => [
                'required',
                Rule::in(['Senior', 'U18', 'U16', 'U14']),
            ],
            'trajner_id' => 'nullable|exists:trajner,id',
        ]);

        Ekipi::create($validated);

        return redirect()->route('ekipet.index')
            ->with('success', 'Ekipi u krijua me sukses!');
    }

    public function show(Ekipi $ekipi)
    {
        $ekipi->load([
            'trajner',
            'lojtaret' => function ($query) {
                $query->orderBy('numriFanelles');
            },
        ]);

        return view('ekipet.show', compact('ekipi'));
    }

    public function edit(Ekipi $ekipi)
    {
        $trajneret = Trajner::orderBy('emri')->get();

        return view('ekipet.edit', compact(
            'ekipi',
            'trajneret'
        ));
    }

    public function update(Request $request, Ekipi $ekipi)
    {
        $validated = $request->validate([
            'emri' => [
                'required', 'string', 'max:255',
                Rule::unique('ekipet', 'emri')
                    ->ignore($ekipi->id),
            ],
            'kategoria' => [
                'required',
                Rule::in(['Senior', 'U18', 'U16', 'U14']),
            ],
            'trajner_id' => 'nullable|exists:trajner,id',
        ]);

        $ekipi->update($validated);

        return redirect()->route('ekipet.index')
            ->with('success', 'Ekipi u perditesua!');
    }

    public function destroy(Ekipi $ekipi)
    {
        $ekipi->delete();

        return redirect()->route('ekipet.index')
            ->with('success', 'Ekipi u fshi!');
    }
}
