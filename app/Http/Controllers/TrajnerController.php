<?php

namespace App\Http\Controllers;

use App\Models\Trajner;
use Illuminate\Http\Request;

class TrajnerController extends Controller
{
    // READ - Display trainers

    public function index(Request $request)
    {
        $search = $request->input('search');

        $trajneret = Trajner::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('emri', 'like', "%{$search}%")
                        ->orWhere('mbiemri', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        $totalTrajnere = Trajner::count();

        return view('trajner.index', compact(
            'trajneret',
            'totalTrajnere'
        ));
    }

    // CREATE - Show form
    public function create()
    {
        return view('trajner.create');
    }

    // STORE - Save new trainer
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
            'IBAN' => 'required|string|max:34',
        ]);

        Trajner::create($validated);

        return redirect()->route('trajner.index')
            ->with('success', 'Trajneri u shtua me sukses!');
    }

    // EDIT - Show edit form
    public function edit(Trajner $trajner)
    {
        return view('trajner.edit', compact('trajner'));
    }

    // UPDATE - Save changes
    public function update(Request $request, Trajner $trajner)
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
            'IBAN' => 'required|string|max:34',
        ]);

        $trajner->update($validated);

        return redirect()->route('trajner.index')
            ->with('success', 'Trajneri u perditesua!');
    }

    // DELETE - Remove trainer
    public function destroy(Trajner $trajner)
    {
        $trajner->delete();

        return redirect()->route('trajner.index')
            ->with('success', 'Trajneri u fshi!');
    }
}
