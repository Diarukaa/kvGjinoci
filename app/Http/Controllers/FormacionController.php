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
            $ndeshja->loadMissing('ekipi');

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

    private function lojtaretEkipit(Ndeshja $ndeshja)
    {
        return Lojtar::query()
            ->where('ekipi_id', $ndeshja->ekipi_id)
            ->orderBy('emri')
            ->orderBy('mbiemri')
            ->get();
    }

    private function kontrolloLojtaret(
        Ndeshja $ndeshja,
        array $pozicionet
    ): void {
        $ids = [];

        foreach (range(1, 6) as $pozicioni) {
            $id = $pozicionet[$pozicioni] ?? null;

            if ($id === null || $id === '') {
                throw ValidationException::withMessages([
                    'pozicionet' =>
                        'Duhet me i zgjedh te 6 lojtaret.',
                ]);
            }

            $ids[] = (int) $id;
        }

        $libero = $pozicionet[7] ?? null;

        if ($libero !== null && $libero !== '') {
            $ids[] = (int) $libero;
        }

        if (count($ids) !== count(array_unique($ids))) {
            throw ValidationException::withMessages([
                'pozicionet' =>
                    'Nje lojtare nuk mund te jete ne dy pozicione.',
            ]);
        }

        $validCount = Lojtar::query()
            ->where('ekipi_id', $ndeshja->ekipi_id)
            ->whereIn('id', $ids)
            ->count();

        if ($validCount !== count($ids)) {
            throw ValidationException::withMessages([
                'pozicionet' =>
                    'Zgjedh vetem lojtare te ekipit te kesaj ndeshjeje.',
            ]);
        }
    }

    private function ruajPozicionet(
        Ndeshja $ndeshja,
        int $seti,
        array $pozicionet
    ): void {
        FormacionPozicioni::query()
            ->where('ndeshja_id', $ndeshja->id)
            ->where('seti', $seti)
            ->delete();

        foreach (range(1, 7) as $pozicioni) {
            $id = $pozicionet[$pozicioni] ?? null;

            if ($id === null || $id === '') {
                continue;
            }

            FormacionPozicioni::create([
                'ndeshja_id' => $ndeshja->id,
                'seti' => $seti,
                'pozicioni' => $pozicioni,
                'lojtar_id' => (int) $id,
            ]);
        }
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
                function ($q) use ($user) {
                    $q->where(
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
            compact('ndeshjet', 'formacionet')
        );
    }

    // FORMACIONI I NJE NDESHJEJE

    public function index(
        Request $request,
        Ndeshja $ndeshja
    ) {
        $ndeshja->load('ekipi');

        $this->autorizo($request, $ndeshja);

        $seti = filter_var(
            $request->query('seti', '1'),
            FILTER_VALIDATE_INT
        );

        abort_unless(
            $seti !== false
            && $seti >= 1
            && $seti <= 5,
            404
        );

        abort_unless($ndeshja->ekipi, 404);

        $lojtaret = $this->lojtaretEkipit($ndeshja);

        $formacioni = FormacionPozicioni::query()
            ->where('ndeshja_id', $ndeshja->id)
            ->where('seti', $seti)
            ->pluck('lojtar_id', 'pozicioni')
            ->map(fn ($id) => (string) $id)
            ->all();

        $teRuajtura = FormacionPozicioni::query()
            ->where('ndeshja_id', $ndeshja->id)
            ->distinct()
            ->pluck('seti')
            ->map(fn ($nr) => (int) $nr)
            ->all();

        // NUMRAT E FANELLES

        $numrat = [];

        foreach ($lojtaret as $lojtare) {
            $numri = $lojtare->getAttribute(
                'numriFanelles'
            );

            // Mbeshtetje per emertime alternative.

            if ($numri === null || $numri === '') {
                foreach ([
                             'numri_fanelles',
                             'numri_faneles',
                             'numri',
                             'jersey_number',
                         ] as $fushe) {
                    $vlera = $lojtare->getAttribute(
                        $fushe
                    );

                    if ($vlera !== null && $vlera !== '') {
                        $numri = $vlera;
                        break;
                    }
                }
            }

            $numrat[$lojtare->id] =
                $numri !== null && $numri !== ''
                    ? (string) $numri
                    : null;
        }

        return view('formacionet.index', compact(
            'ndeshja',
            'lojtaret',
            'formacioni',
            'seti',
            'teRuajtura',
            'numrat'
        ));
    }

    // RUAJTJA E FORMACIONIT

    public function store(
        Request $request,
        Ndeshja $ndeshja
    ) {
        $ndeshja->load('ekipi');

        $this->autorizo($request, $ndeshja);

        $validated = $request->validate([
            'seti' => [
                'required',
                'integer',
                'between:1,5',
            ],
            'pozicionet' => [
                'required',
                'array',
                'size:7',
            ],
            'pozicionet.1' => ['required', 'integer'],
            'pozicionet.2' => ['required', 'integer'],
            'pozicionet.3' => ['required', 'integer'],
            'pozicionet.4' => ['required', 'integer'],
            'pozicionet.5' => ['required', 'integer'],
            'pozicionet.6' => ['required', 'integer'],
            'pozicionet.7' => ['nullable', 'integer'],
        ]);

        DB::transaction(function () use (
            $request,
            $ndeshja,
            $validated
        ) {
            $locked = Ndeshja::query()
                ->lockForUpdate()
                ->findOrFail($ndeshja->id);

            $locked->load('ekipi');

            $this->autorizo($request, $locked);

            $pozicionet = $validated['pozicionet'];

            $this->kontrolloLojtaret(
                $locked,
                $pozicionet
            );

            $this->ruajPozicionet(
                $locked,
                (int) $validated['seti'],
                $pozicionet
            );
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

    // KOPJIMI I FORMACIONIT

    public function kopjo(
        Request $request,
        Ndeshja $ndeshja
    ) {
        $ndeshja->load('ekipi');

        $this->autorizo($request, $ndeshja);

        $validated = $request->validate([
            'seti_nga' => [
                'required',
                'integer',
                'between:1,5',
            ],
            'seti_ne' => [
                'required',
                'integer',
                'between:1,5',
                'different:seti_nga',
            ],
            'overwrite' => [
                'nullable',
                'accepted',
            ],
        ]);

        $nga = (int) $validated['seti_nga'];
        $ne = (int) $validated['seti_ne'];

        DB::transaction(function () use (
            $request,
            $ndeshja,
            $nga,
            $ne,
            $validated
        ) {
            $locked = Ndeshja::query()
                ->lockForUpdate()
                ->findOrFail($ndeshja->id);

            $locked->load('ekipi');

            $this->autorizo($request, $locked);

            $burimi = FormacionPozicioni::query()
                ->where('ndeshja_id', $locked->id)
                ->where('seti', $nga)
                ->pluck('lojtar_id', 'pozicioni')
                ->all();

            foreach (range(1, 6) as $pozicioni) {
                if (empty($burimi[$pozicioni])) {
                    throw ValidationException::withMessages([
                        'seti_nga' =>
                            'Seti burimor nuk ka formacion te plote.',
                    ]);
                }
            }

            $this->kontrolloLojtaret(
                $locked,
                $burimi
            );

            $destinacioniEkziston =
                FormacionPozicioni::query()
                    ->where('ndeshja_id', $locked->id)
                    ->where('seti', $ne)
                    ->exists();

            if (
                $destinacioniEkziston
                && !($validated['overwrite'] ?? false)
            ) {
                throw ValidationException::withMessages([
                    'seti_ne' =>
                        'Seti destinacion ka formacion. Konfirmo mbishkrimin.',
                ]);
            }

            $this->ruajPozicionet(
                $locked,
                $ne,
                $burimi
            );
        });

        return redirect()
            ->route('formacionet.index', [
                'ndeshja' => $ndeshja->id,
                'seti' => $ne,
            ])
            ->with(
                'success',
                "Formacioni u kopjua nga Seti {$nga} ne Setin {$ne}."
            );
    }
}
