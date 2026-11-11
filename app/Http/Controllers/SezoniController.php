<?php

namespace App\Http\Controllers;

use App\Models\Sezoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class SezoniController extends Controller
{
    public function index()
    {
        $sezonet = Sezoni::withCount('ndeshjet')
            ->orderByDesc('data_fillimit')
            ->get();

        return view('sezonet.index', compact('sezonet'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'emri' => 'required|string|max:30|unique:sezonet,emri',
            'data_fillimit' => 'required|date',
            'data_mbarimit' => 'required|date|after:data_fillimit',
            'aktiv' => 'required|boolean',
        ]);

        DB::transaction(function () use ($data) {
            if ($data['aktiv']) {
                Sezoni::where('aktiv', true)
                    ->update(['aktiv' => false]);
            }

            Sezoni::create($data);
        });

        return redirect()->route('sezonet.index')
            ->with('success', 'Sezoni u krijua me sukses!');
    }

    public function update(Request $request, Sezoni $sezoni)
    {
        $data = $request->validate([
            'emri' => [
                'required', 'string', 'max:30',
                Rule::unique('sezonet', 'emri')
                    ->ignore($sezoni->id),
            ],
            'data_fillimit' => 'required|date',
            'data_mbarimit' => 'required|date|after:data_fillimit',
            'aktiv' => 'required|boolean',
        ]);

        DB::transaction(function () use ($data, $sezoni) {
            if ($data['aktiv']) {
                Sezoni::where('aktiv', true)
                    ->where('id', '!=', $sezoni->id)
                    ->update(['aktiv' => false]);
            }

            $sezoni->update($data);
        });

        return redirect()->route('sezonet.index')
            ->with('success', 'Sezoni u perditesua!');
    }

    public function destroy(Sezoni $sezoni)
    {
        if ($sezoni->ndeshjet()->exists()) {
            throw ValidationException::withMessages([
                'sezoni' => 'Ky sezon ka ndeshje. Nuk mund te fshihet.'
            ]);
        }

        $sezoni->delete();

        return redirect()->route('sezonet.index')
            ->with('success', 'Sezoni u fshi!');
    }
}
