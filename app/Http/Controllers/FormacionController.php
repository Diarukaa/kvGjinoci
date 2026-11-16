<?php

namespace App\Http\Controllers;

use App\Models\FormacionPozicioni;
use App\Models\Lojtar;
use App\Models\Ndeshja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class FormacionController extends Controller
{
    private function autorizo(
        Request $request,
        Ndeshja $ndeshja
    ): void {
        $user = $request->user();

        abort_unless($user, 401);

        if (in_array(
            $user->role,
            ['admin', 'manager'],
            true
        )) {
            return;
        }

        if ($user->role === 'coach') {
            abort_unless(
                $user->trajner_id
                && $ndeshja->ekipi
                && (int) $ndeshja->ekipi->trajner_id
                === (int) $user->trajner_id,
                403,
                'Nuk ke qasje ne kete ekip.'
            );

            return;
        }

        abort(403);
    }

    // LISTA E NDESHJEVE

    public function lista(Request $request)
    {
        $user = $request->user();

        abort_unless(
            in_array(
                $user->role,
                ['admin', 'manager', 'coach'],
                true
            ),
            403
        );

        $query = Ndeshja::query()
            ->with('ekipi');

        if ($user->role === 'coach') {
            $query->whereHas(
                'ekipi',
                function ($ekipiQuery) use ($user) {
                    $ekipiQuery->where(
                        'trajner_id',
                        $user->trajner_id ?? 0
                    );
                }
            );
        }

        $ndeshjet = $query
            ->orderByDesc('data_ndeshjes')
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();

        $ids = $ndeshjet
            ->getCollection()
            ->pluck('id');

        $formacionet = FormacionPozicioni::query()
            ->whereIn('ndeshja_id', $ids)
            ->select('ndeshja_id', 'seti')
            ->distinct()
            ->get()
            ->groupBy('ndeshja_id');

        return view(
            'formacionet.lista',
            compact(
                'ndeshjet',
                'formacionet'
            )
        );
    }

    // HAPE FORMACIONIN E NJE NDESHJEJE

    public function index(
        Request $request,
        Ndeshja $ndeshja
    ) {
        $ndeshja->load('ekipi');

        $this->autorizo(
            $request,
            $ndeshja
        );

        $seti = (int) $request->query('seti', 1);

        abort_unless(
            $seti >= 1 && $seti <= 5,
            404
        );

        abort_unless(
            $ndeshja->ekipi,
            404
        );

        $lojtaret = Lojtar::query()
            ->where(
                'ekipi_id',
                $ndeshja->ekipi_id
            )
            ->orderBy('emri')
            ->orderBy('mbiemri')
            ->get();

        $formacioni = FormacionPozicioni::query()
            ->where(
                'ndeshja_id',
                $ndeshja->id
            )
            ->where('seti', $seti)
            ->pluck(
                'lojtar_id',
                'pozicioni'
            )
            ->map(
                fn ($id) => (string) $id
            )
            ->all();

        $teRuajtura = FormacionPozicioni::query()
            ->where(
                'ndeshja_id',
                $ndeshja->id
            )
            ->select('seti')
            ->distinct()
            ->pluck('seti')
            ->map(
                fn ($nr) => (int) $nr
            )
            ->all();

        return view(
            'formacionet.index',
            compact(
                'ndeshja',
                'lojtaret',
                'formacioni',
                'seti',
                'teRuajtura'
            )
        );
    }

    // RUAJ FORMACIONIN

    public function store(
        Request $request,
        Ndeshja $ndeshja
    ) {
        $ndeshja->load('ekipi');

        $this->autorizo(
            $request,
            $ndeshja
        );

        $validated = $request->validate([
            'seti' => [
                'required',
                'integer',
                'between:1,5',
            ],

            'pozicionet' => [
                'required',
                'array',
            ],

            'pozicionet.1' => [
                'required',
                'integer',
            ],

            'pozicionet.2' => [
                'required',
                'integer',
            ],

            'pozicionet.3' => [
                'required',
                'integer',
            ],

            'pozicionet.4' => [
                'required',
                'integer',
            ],

            'pozicionet.5' => [
                'required',
                'integer',
            ],

            'pozicionet.6' => [
                'required',
                'integer',
            ],

            'pozicionet.7' => [
                'nullable',
                'integer',
            ],
        ]);

        $pozicionet = $validated['pozicionet'];

        $ids = [];

        foreach (range(1, 7) as $pos) {
            $id = $pozicionet[$pos]
                ?? $pozicionet[(string) $pos]
                ?? null;

            if ($id !== null && $id !== '') {
                $ids[] = (int) $id;
            }
        }

        if (count($ids) !== count(array_unique($ids))) {
            throw ValidationException::withMessages([
                'pozicionet' =>
                    'Nje lojtare nuk mund te jete ne dy pozicione.',
            ]);
        }

        DB::transaction(function () use (
            $request,
            $ndeshja,
            $validated,
            $pozicionet,
            $ids
        ) {
            $lockedNdeshja = Ndeshja::query()
                ->with('ekipi')
                ->lockForUpdate()
                ->findOrFail($ndeshja->id);

            $this->autorizo(
                $request,
                $lockedNdeshja
            );

            $validCount = Lojtar::query()
                ->where(
                    'ekipi_id',
                    $lockedNdeshja->ekipi_id
                )
                ->whereIn('id', $ids)
                ->count();

            if ($validCount !== count($ids)) {
                throw ValidationException::withMessages([
                    'pozicionet' =>
                        'Zgjidh vetem lojtare te ekipit te kesaj ndeshjeje.',
                ]);
            }

            $seti = (int) $validated['seti'];

            FormacionPozicioni::query()
                ->where(
                    'ndeshja_id',
                    $lockedNdeshja->id
                )
                ->where('seti', $seti)
                ->delete();

            foreach (range(1, 7) as $pos) {
                $id = $pozicionet[$pos]
                    ?? $pozicionet[(string) $pos]
                    ?? null;

                if ($id === null || $id === '') {
                    continue;
                }

                FormacionPozicioni::create([
                    'ndeshja_id' =>
                        $lockedNdeshja->id,

                    'seti' => $seti,

                    'pozicioni' => $pos,

                    'lojtar_id' => (int) $id,
                ]);
            }
        });

        return redirect()
            ->route('formacionet.index', [
                'ndeshja' => $ndeshja->id,
                'seti' => $validated['seti'],
            ])
            ->with(
                'success',
                'Formacioni u ruajt me sukses.'
            );
    }
}
