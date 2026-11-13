<?php

namespace App\Http\Controllers;

use App\Models\Ekipi;
use App\Models\Lojtar;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LojtarController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $lojtaret = Lojtar::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('emri', 'like', "%{$search}%")
                        ->orWhere('mbiemri', 'like', "%{$search}%");
                });
            })
            ->orderBy('numriFanelles')
            ->paginate(10)
            ->withQueryString();

        $totalLojtare = Lojtar::count();

        return view('lojtar.index', compact(
            'lojtaret',
            'totalLojtare'
        ));
    }

    public function create()
    {
        $ekipet = Ekipi::orderBy('emri')->get();

        return view('lojtar.create', compact('ekipet'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'emri' => 'required|string|max:255',
            'mbiemri' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'dataELindjes' => 'required|date',
            'nrTelefonit' => [
                'required',
                'string',
                'regex:/^\+3834[0-9]{7}$/'
            ],
            'vendbanimi' => 'required|string|max:255',
            'numriFanelles' => [
                'required', 'integer', 'between:1,99',
                Rule::unique('lojtar', 'numriFanelles'),
            ],
            'pozicioni' => [
                'required',
                Rule::in([
                    'Setter',
                    'Libero',
                    'Outside Hitter',
                    'Opposite Hitter',
                    'Middle Blocker',
                ]),
            ],
            'gjatesia' => 'nullable|integer|between:100,250',
            'ekipi_id' => 'nullable|exists:ekipet,id',
        ]);

        Lojtar::create($validated);

        return redirect()->route('lojtar.index')
            ->with('success', 'Volejbollistja u regjistrua!');
    }

    public function show(Lojtar $lojtar)
    {
        return view('lojtar.show', compact('lojtar'));
    }

    public function edit(Lojtar $lojtar)
    {
        $ekipet = Ekipi::orderBy('emri')->get();

        return view('lojtar.edit', compact('lojtar', 'ekipet'));
    }

    public function update(Request $request, Lojtar $lojtar)
    {
        $validated = $request->validate([
            'emri' => 'required|string|max:255',
            'mbiemri' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'dataELindjes' => 'required|date',
            'nrTelefonit' => [
                'required',
                'string',
                'regex:/^\+3834[0-9]{7}$/'
            ],
            'vendbanimi' => 'required|string|max:255',
            'numriFanelles' => [
                'required', 'integer', 'between:1,99',
                Rule::unique('lojtar', 'numriFanelles')
                    ->ignore($lojtar->getKey()),
            ],
            'pozicioni' => [
                'required',
                Rule::in([
                    'Setter',
                    'Libero',
                    'Outside Hitter',
                    'Opposite Hitter',
                    'Middle Blocker',
                ]),
            ],
            'gjatesia' => 'nullable|integer|between:100,250',
            'ekipi_id' => 'nullable|exists:ekipet,id',
        ]);

        $lojtar->update($validated);

        return redirect()->route('lojtar.index')
            ->with('success', 'Te dhenat u perditesuan!');
    }

    public function destroy(Lojtar $lojtar)
    {
        $lojtar->delete();

        return redirect()->route('lojtar.index')
            ->with('success', 'Volejbollistja u fshi!');
    }
}
