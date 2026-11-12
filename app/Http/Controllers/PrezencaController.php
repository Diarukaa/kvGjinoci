<?php

namespace App\Http\Controllers;

use App\Models\Stervitja;
use App\Models\Lojtar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PrezencaController extends Controller
{
    public function edit(Stervitja $stervitja)
    {
        $stervitja->load(['ekipi', 'trajner']);

        $prezencat = $stervitja->prezencat()
            ->get()
            ->keyBy('lojtar_id');

        $lojtaret = Lojtar::query()
            ->where(function ($query) use ($stervitja, $prezencat) {
                $query->where('ekipi_id', $stervitja->ekipi_id)
                    ->orWhereIn('id', $prezencat->keys());
            })
            ->orderBy('numriFanelles')
            ->get();

        return view('prezencat.edit', compact(
            'stervitja',
            'lojtaret',
            'prezencat'
        ));
    }

    public function update(
        Request $request,
        Stervitja $stervitja
    ) {
        $data = $request->validate([
            'prezencat' => 'required|array|min:1',

            'prezencat.*.statusi' =>
                'required|in:Prezente,Mungon,Me vonese,E arsyetuar',

            'prezencat.*.shenime' =>
                'nullable|string|max:500',
        ]);

        DB::transaction(function () use ($data, $stervitja) {
            $stervitja = Stervitja::whereKey($stervitja->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($stervitja->statusi !== 'Perfunduar') {
                throw ValidationException::withMessages([
                    'prezencat' =>
                        'Stervitja duhet te jete e perfunduar.'
                ]);
            }

            $prezencaEkzistuese = $stervitja->prezencat()
                ->pluck('lojtar_id');

            $lojtaret = Lojtar::query()
                ->where(function ($query) use (
                    $stervitja,
                    $prezencaEkzistuese
                ) {
                    $query->where('ekipi_id', $stervitja->ekipi_id)
                        ->orWhereIn('id', $prezencaEkzistuese);
                })
                ->pluck('id')
                ->map(fn ($id) => (int) $id);

            $ids = collect(array_keys($data['prezencat']))
                ->map(fn ($id) => (int) $id);

            if (
                $ids->diff($lojtaret)->isNotEmpty() ||
                $lojtaret->diff($ids)->isNotEmpty() ||
                $ids->count() !== $lojtaret->count()
            ) {
                throw ValidationException::withMessages([
                    'prezencat' =>
                        'Lista e volejbollisteve nuk perputhet me ekipin.'
                ]);
            }

            foreach ($data['prezencat'] as $lojtarId => $prezenca) {
                $stervitja->prezencat()->updateOrCreate(
                    [
                        'lojtar_id' => $lojtarId,
                    ],
                    [
                        'statusi' => $prezenca['statusi'],
                        'shenime' => $prezenca['shenime'] ?? null,
                    ]
                );
            }
        });

        return redirect()
            ->route('stervitjet.show', $stervitja)
            ->with('success', 'Prezenca u ruajt me sukses!');
    }

    public function historiku(Lojtar $lojtar)
    {
        $prezencat = $lojtar->prezencat()
            ->with('stervitja.ekipi')
            ->whereHas('stervitja', fn ($query) =>
            $query->where('statusi', 'Perfunduar'))
            ->get()
            ->sortByDesc(fn ($p) => $p->stervitja->data)
            ->values();

        $total = $prezencat->count();

        $prezente = $prezencat
            ->where('statusi', 'Prezente')->count();

        $mungesa = $prezencat
            ->where('statusi', 'Mungon')->count();

        $vonese = $prezencat
            ->where('statusi', 'Me vonese')->count();

        $arsyetuara = $prezencat
            ->where('statusi', 'E arsyetuar')->count();

        $perqindja = $total > 0
            ? round(($prezente + $vonese) / $total * 100, 1)
            : 0;

        return view('prezencat.historiku', compact(
            'lojtar',
            'prezencat',
            'total',
            'prezente',
            'mungesa',
            'vonese',
            'arsyetuara',
            'perqindja'
        ));
    }
}
