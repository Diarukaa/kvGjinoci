<?php

namespace App\Http\Controllers;

use App\Models\Ekipi;
use App\Models\Ndeshja;
use App\Models\Sezoni;
use App\Models\StatistikaLojtarit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;

class CoachMatchController extends Controller
{
    private function ekipetIds(Request $request)
    {
        abort_unless(
            $request->user()->role === 'coach',
            403
        );

        $trajner = $request->user()->trajner;

        abort_unless(
            $trajner,
            403,
            'Profili i trajnerit nuk eshte lidhur.'
        );

        return Ekipi::where(
            'trajner_id',
            $trajner->id
        )->pluck('id');
    }

    private function kontrolloNdeshjen(
        Request $request,
        Ndeshja $ndeshja
    ): void
    {
        abort_unless(
            $this->ekipetIds($request)
                ->contains($ndeshja->ekipi_id),
            403,
            'Nuk ke leje per kete ndeshje.'
        );
    }

    public function create(Request $request)
    {
        $ekipet = Ekipi::whereIn(
            'id',
            $this->ekipetIds($request)
        )->orderBy('emri')->get();

        $sezonet = Sezoni::all();

        $ndeshja = new Ndeshja();

        return view('coach.ndeshja-form', compact(
            'ekipet',
            'sezonet',
            'ndeshja'
        ));
    }

    public function store(Request $request)
    {
        $this->validimi($request);

        $response = app(NdeshjaController::class)
            ->store($request);

        return $this->pergjigjja(
            $request,
            $response,
            'Ndeshja u krijua me sukses.'
        );
    }

    public function edit(
        Request $request,
        Ndeshja $ndeshja
    )
    {
        $this->kontrolloNdeshjen(
            $request,
            $ndeshja
        );

        $ndeshja->load('setet');

        $ekipet = Ekipi::whereIn(
            'id',
            $this->ekipetIds($request)
        )->orderBy('emri')->get();

        $sezonet = Sezoni::all();

        return view('coach.ndeshja-form', compact(
            'ekipet',
            'sezonet',
            'ndeshja'
        ));
    }

    public function update(
        Request $request,
        Ndeshja $ndeshja
    )
    {
        $this->kontrolloNdeshjen(
            $request,
            $ndeshja
        );

        $this->validimi(
            $request,
            $ndeshja
        );

        $response = app(NdeshjaController::class)
            ->update($request, $ndeshja);

        return $this->pergjigjja(
            $request,
            $response,
            'Ndeshja u perditesua me sukses.'
        );
    }

    private function validimi(
        Request $request,
        ?Ndeshja $ndeshja = null
    ): void
    {
        $validated = $request->validate([

            'ekipi_id' => [
                'required',
                'integer',
                Rule::in(
                    $this->ekipetIds($request)->all()
                ),
            ],

            'sezoni_id' => [
                'nullable',
                'integer',
                Rule::exists(
                    (new Sezoni())->getTable(),
                    'id'
                ),
            ],

            'kundershtari' => [
                'required',
                'string',
                'max:255',
            ],

            'data_ndeshjes' => [
                'required',
                'date',
            ],

            'palestra' => [
                'required',
                'string',
                'max:255',
            ],

            'lokacioni' => [
                'required',
                Rule::in(['Vendas', 'Mysafir']),
            ],

            'statusi' => [
                'required',
                Rule::in([
                    'Planifikuar',
                    'Perfunduar',
                ]),
            ],
        ]);

        // Mos ndrysho ekipin e nje ndeshjeje ekzistuese

        if (
            $ndeshja &&
            (int) $ndeshja->ekipi_id !==
            (int) $validated['ekipi_id']
        ) {
            throw ValidationException::withMessages([
                'ekipi_id' =>
                    'Nuk mund te ndryshosh ekipin e kesaj ndeshjeje.',
            ]);
        }

        // Mos e kthe ndeshjen ne Planifikuar
        // nese ka statistika individuale

        if (
            $ndeshja &&
            $validated['statusi'] === 'Planifikuar' &&
            StatistikaLojtarit::where(
                'ndeshja_id',
                $ndeshja->id
            )->exists()
        ) {
            throw ValidationException::withMessages([
                'statusi' =>
                    'Ndeshja ka statistika individuale te regjistruara.',
            ]);
        }

        if ($validated['statusi'] === 'Planifikuar') {

            $request->merge([
                'setet' => [],
                'setet_tona' => 0,
                'setet_kundershtarit' => 0,
            ]);

            return;
        }

        $rezultatet = $request->validate([
            'setet' => [
                'required',
                'array',
                'min:3',
                'max:5',
            ],

            'setet.*.numri_setit' => [
                'required',
                'integer',
                'between:1,5',
            ],

            'setet.*.piket_tona' => [
                'required',
                'integer',
                'min:0',
                'max:999',
            ],

            'setet.*.piket_kundershtarit' => [
                'required',
                'integer',
                'min:0',
                'max:999',
            ],
        ]);

        $setet = array_values(
            $rezultatet['setet']
        );

        $tona = 0;
        $kundershtarit = 0;

        foreach ($setet as $index => $seti) {

            $numri = $index + 1;

            $a = (int) $seti['piket_tona'];

            $b = (int) $seti['piket_kundershtarit'];

            $minimum = $numri === 5 ? 15 : 25;

            if (
                (int) $seti['numri_setit'] !== $numri ||
                $tona === 3 ||
                $kundershtarit === 3
            ) {
                throw ValidationException::withMessages([
                    'setet' =>
                        'Kontrollo renditjen dhe numrin e seteve.',
                ]);
            }

            $fituesi = max($a, $b);

            $humbesi = min($a, $b);

            if (
                $fituesi !== max(
                    $minimum,
                    $humbesi + 2
                )
            ) {
                throw ValidationException::withMessages([
                    'setet' =>
                        "Rezultati i setit {$numri} nuk eshte valid.",
                ]);
            }

            if ($a > $b) {
                $tona++;
            } else {
                $kundershtarit++;
            }
        }

        if (
            $tona !== 3 &&
            $kundershtarit !== 3
        ) {
            throw ValidationException::withMessages([
                'setet' =>
                    'Nje ekip duhet t\'i fitoje 3 sete.',
            ]);
        }

        $request->merge([
            'setet' => $setet,
            'setet_tona' => $tona,
            'setet_kundershtarit' => $kundershtarit,
        ]);
    }

    private function pergjigjja(
        Request $request,
                $response,
        string $mesazhi
    )
    {
        if (!$response instanceof RedirectResponse) {
            return $response;
        }

        if ($request->session()->has('errors')) {
            return $response;
        }

        return redirect()
            ->route('coach.ndeshjet')
            ->with(
                'success',
                $request->session()->get(
                    'success',
                    $mesazhi
                )
            );
    }
}
