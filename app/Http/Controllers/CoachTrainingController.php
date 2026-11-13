<?php

namespace App\Http\Controllers;

use App\Models\Ekipi;
use App\Models\Lojtar;
use App\Models\Sezoni;
use App\Models\Stervitja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class CoachTrainingController extends Controller
{
    private function trajneri(Request $request)
    {
        abort_unless($request->user()->role === 'coach', 403);

        $trajner = $request->user()->trajner;

        abort_unless(
            $trajner,
            403,
            'Profili i trajnerit nuk eshte lidhur.'
        );

        return $trajner;
    }

    private function ekipetIds(Request $request)
    {
        return Ekipi::where(
            'trajner_id',
            $this->trajneri($request)->id
        )->pluck('id');
    }

    private function kontrolloStervitjen(
        Request $request,
        Stervitja $stervitja
    ): void
    {
        abort_unless(
            $this->ekipetIds($request)
                ->contains($stervitja->ekipi_id),
            403,
            'Nuk ke leje per kete stervitje.'
        );
    }

    public function index(Request $request)
    {
        $stervitjet = Stervitja::with('ekipi', 'trajner')
            ->whereIn('ekipi_id', $this->ekipetIds($request))
            ->orderByDesc('data')
            ->orderBy('ora_fillimit')
            ->get();

        return view(
            'coach.stervitjet',
            compact('stervitjet')
        );
    }

    public function create(Request $request)
    {
        $ekipet = Ekipi::whereIn(
            'id',
            $this->ekipetIds($request)
        )->get();

        $sezonet = Sezoni::orderByDesc('data_fillimit')->get();

        $stervitja = new Stervitja();

        return view('coach.stervitja-form', compact(
            'ekipet',
            'sezonet',
            'stervitja'
        ));
    }

    public function store(Request $request)
    {
        $validated = $this->validimi($request);

        $stervitja = new Stervitja();

        $stervitja->fill($validated);

        $stervitja->trajner_id =
            $this->trajneri($request)->id;

        $stervitja->save();

        return redirect()
            ->route('coach.stervitjet')
            ->with('success', 'Stervitja u krijua me sukses.');
    }

    public function edit(
        Request $request,
        Stervitja $stervitja
    )
    {
        $this->kontrolloStervitjen($request, $stervitja);

        $ekipet = Ekipi::whereIn(
            'id',
            $this->ekipetIds($request)
        )->get();

        $sezonet = Sezoni::orderByDesc('data_fillimit')->get();

        return view('coach.stervitja-form', compact(
            'stervitja',
            'ekipet',
            'sezonet'
        ));
    }

    public function update(
        Request $request,
        Stervitja $stervitja
    )
    {
        $this->kontrolloStervitjen($request, $stervitja);

        $validated = $this->validimi(
            $request,
            $stervitja
        );

        if (
            (int) $validated['ekipi_id'] !==
            (int) $stervitja->ekipi_id
            && $stervitja->prezencat()->exists()
        ) {
            throw ValidationException::withMessages([
                'ekipi_id' => 'Nuk mund te ndryshosh ekipin pasi eshte regjistruar prezenca.'
            ]);
        }

        $stervitja->fill($validated);

        $stervitja->trajner_id =
            $this->trajneri($request)->id;

        $stervitja->save();

        return redirect()
            ->route('coach.stervitjet')
            ->with('success', 'Stervitja u perditesua me sukses.');
    }

    private function validimi(
        Request $request,
        ?Stervitja $stervitja = null
    ): array
    {
        $trajner = $this->trajneri($request);

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

            'data' => [
                'required',
                'date_format:Y-m-d',
            ],

            'ora_fillimit' => [
                'required',
                'date_format:H:i',
            ],

            'ora_mbarimit' => [
                'required',
                'date_format:H:i',
                'after:ora_fillimit',
            ],

            'palestra' => [
                'required',
                'string',
                'max:255',
            ],

            'lloji' => [
                'required',
                Rule::in([
                    'Fizike',
                    'Teknike',
                    'Taktike',
                    'Miqesore',
                    'Rikuperim',
                ]),
            ],

            'statusi' => [
                'required',
                Rule::in([
                    'Planifikuar',
                    'Perfunduar',
                    'Anuluar',
                ]),
            ],

            'pershkrimi' => [
                'nullable',
                'string',
                'max:5000',
            ],

        ]);

        // Kontrollo daten brenda sezonit

        if (!empty($validated['sezoni_id'])) {

            $sezoni = Sezoni::findOrFail(
                $validated['sezoni_id']
            );

            $data = Carbon::parse(
                $validated['data']
            )->startOfDay();

            if (
                $data->lt(
                    Carbon::parse($sezoni->data_fillimit)
                        ->startOfDay()
                )
                ||
                $data->gt(
                    Carbon::parse($sezoni->data_mbarimit)
                        ->startOfDay()
                )
            ) {
                throw ValidationException::withMessages([
                    'data' => 'Data e stervitjes duhet te jete brenda sezonit.'
                ]);
            }
        }

        // Kontrollo perplasje te orarit

        if ($validated['statusi'] !== 'Anuluar') {

            $konflikt = Stervitja::whereDate(
                'data',
                $validated['data']
            )
                ->where('statusi', '!=', 'Anuluar')
                ->where(function ($query) use (
                    $validated,
                    $trajner
                ) {
                    $query
                        ->where('ekipi_id', $validated['ekipi_id'])
                        ->orWhere('trajner_id', $trajner->id);
                })
                ->where(
                    'ora_fillimit',
                    '<',
                    $validated['ora_mbarimit']
                )
                ->where(
                    'ora_mbarimit',
                    '>',
                    $validated['ora_fillimit']
                )
                ->when(
                    $stervitja,
                    fn ($query) => $query->where(
                        'id',
                        '!=',
                        $stervitja->id
                    )
                )
                ->exists();

            if ($konflikt) {
                throw ValidationException::withMessages([
                    'ora_fillimit' => 'Ekziston nje stervitje tjeter ne kete orar.'
                ]);
            }
        }

        return $validated;
    }

    public function prezenca(
        Request $request,
        Stervitja $stervitja
    )
    {
        $this->kontrolloStervitjen($request, $stervitja);

        $stervitja->load('ekipi');

        $lojtaret = Lojtar::where(
            'ekipi_id',
            $stervitja->ekipi_id
        )->orderBy('emri')->get();

        $prezencat = $stervitja->prezencat()
            ->get()
            ->keyBy('lojtar_id');

        return view('coach.prezenca', compact(
            'stervitja',
            'lojtaret',
            'prezencat'
        ));
    }

    public function ruajPrezencen(
        Request $request,
        Stervitja $stervitja
    )
    {
        $this->kontrolloStervitjen($request, $stervitja);

        abort_unless(
            $stervitja->statusi === 'Perfunduar',
            422,
            'Vetem stervitjet e perfunduara mund te kene prezence.'
        );

        $validated = $request->validate([

            'prezencat' => [
                'required',
                'array',
            ],

            'prezencat.*' => [
                'required',
                'array:statusi,shenime',
            ],

            'prezencat.*.statusi' => [
                'required',
                Rule::in([
                    'Prezente',
                    'Mungon',
                    'Me vonese',
                    'E arsyetuar',
                ]),
            ],

            'prezencat.*.shenime' => [
                'nullable',
                'string',
                'max:1000',
            ],

        ]);

        $lojtaretIds = Lojtar::where(
            'ekipi_id',
            $stervitja->ekipi_id
        )->pluck('id');

        // Mos lejo regjistrimin e lojtareve te ekipeve tjera

        foreach ($validated['prezencat'] as $lojtarId => $prezenca) {

            abort_unless(
                ctype_digit((string) $lojtarId)
                && $lojtaretIds->contains((int) $lojtarId),
                403,
                'Volejbollistja nuk i takon ketij ekipi.'
            );

        }

        DB::transaction(function () use (
            $validated,
            $stervitja
        ) {

            foreach ($validated['prezencat'] as $lojtarId => $prezenca) {

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

        return back()->with(
            'success',
            'Prezenca u ruajt me sukses.'
        );
    }
}
