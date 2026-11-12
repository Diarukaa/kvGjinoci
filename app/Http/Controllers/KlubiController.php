<?php

namespace App\Http\Controllers;

use App\Models\Klubi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KlubiController extends Controller
{
    public function index()
    {
        $klubet = Klubi::withCount('kampionatet')
            ->orderBy('emri')
            ->get();

        return view('klubet.index', compact('klubet'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'emri' => 'required|string|max:255|unique:klubet,emri',
            'qyteti' => 'nullable|string|max:255',
        ]);

        Klubi::create($data);

        return redirect()->route('klubet.index')
            ->with('success', 'Klubi u regjistrua!');
    }

    public function update(Request $request, Klubi $klubi)
    {
        $data = $request->validate([
            'emri' => [
                'required',
                'string',
                'max:255',
                Rule::unique('klubet', 'emri')
                    ->ignore($klubi->id),
            ],
            'qyteti' => 'nullable|string|max:255',
        ]);

        $klubi->update($data);

        return redirect()->route('klubet.index')
            ->with('success', 'Klubi u perditesua!');
    }

    public function destroy(Klubi $klubi)
    {
        if ($klubi->kampionatet()->exists()) {
            return back()->withErrors([
                'klubi' => 'Klubi merr pjese ne nje kampionat.'
            ]);
        }

        $klubi->delete();

        return redirect()->route('klubet.index')
            ->with('success', 'Klubi u fshi!');
    }
}
