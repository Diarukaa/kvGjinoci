<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kontrata;
use App\Models\Pagesa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class FinanceController extends Controller
{
    private function kontrolloLejen(Request $request): void
    {
        abort_unless(
            in_array(
                $request->user()->role,
                ['admin', 'manager'],
                true
            ),
            403
        );
    }

    public function index(Request $request)
    {
        $this->kontrolloLejen($request);

        $kontratat = Kontrata::with([
            'user',
            'pagesat'
        ])->latest()->get();

        $pagesat = Pagesa::with('kontrata.user')
            ->orderByDesc('muaji')
            ->orderByDesc('id')
            ->get();

        $totalKontrata = $kontratat->count();

        $kontrataAktive = $kontratat
            ->filter(fn ($k) => $k->eshteAktive())
            ->count();

        $totalPaguar = Pagesa::where(
            'statusi',
            'Paguar'
        )->sum('shuma');

        $totalPapaguar = Pagesa::where(
            'statusi',
            'Pa paguar'
        )->sum('shuma');

        $pagaMujore = $kontratat
            ->filter(fn ($k) => $k->eshteAktive())
            ->sum('paga_mujore');

        $perdoruesit = User::whereIn('role', [
            'coach',
            'player',
            'manager'
        ])->orderBy('name')->get();

        return view('financat.index', compact(
            'kontratat',
            'pagesat',
            'perdoruesit',
            'totalKontrata',
            'kontrataAktive',
            'totalPaguar',
            'totalPapaguar',
            'pagaMujore'
        ));
    }

    public function storeKontrata(Request $request)
    {
        $this->kontrolloLejen($request);

        $validated = $request->validate([

            'user_id' => [
                'required',
                'integer',
                Rule::exists('users', 'id')
                    ->whereIn('role', [
                        'coach',
                        'player',
                        'manager'
                    ]),
            ],

            'numri_kontrates' => [
                'required',
                'string',
                'max:100',
                Rule::unique(
                    'kontratat',
                    'numri_kontrates'
                ),
            ],

            'paga_mujore' => [
                'required',
                'numeric',
                'decimal:0,2',
                'min:0.01',
                'max:99999999.99',
            ],

            'data_fillimit' => [
                'required',
                'date_format:Y-m-d',
            ],

            'data_mbarimit' => [
                'required',
                'date_format:Y-m-d',
                'after_or_equal:data_fillimit',
            ],

            'shenime' => [
                'nullable',
                'string',
                'max:5000',
            ],

        ]);

        DB::transaction(function () use ($validated) {

            $user = User::lockForUpdate()
                ->findOrFail($validated['user_id']);

            abort_unless(
                in_array(
                    $user->role,
                    ['coach', 'player', 'manager'],
                    true
                ),
                422
            );

            $konflikt = Kontrata::where(
                'user_id',
                $user->id
            )
                ->where('statusi', 'Aktive')
                ->where(
                    'data_fillimit',
                    '<=',
                    $validated['data_mbarimit']
                )
                ->where(
                    'data_mbarimit',
                    '>=',
                    $validated['data_fillimit']
                )
                ->exists();

            if ($konflikt) {
                throw ValidationException::withMessages([
                    'data_fillimit' =>
                        'Ky perdorues ka nje kontrate tjeter ne kete periudhe.'
                ]);
            }

            Kontrata::create([
                ...$validated,
                'roli' => $user->role,
                'statusi' => 'Aktive',
            ]);

        });

        return back()->with(
            'success',
            'Kontrata u krijua me sukses.'
        );
    }

    public function gjeneroPagen(
        Request $request,
        Kontrata $kontrata
    )
    {
        $this->kontrolloLejen($request);

        $validated = $request->validate([
            'muaji' => [
                'required',
                'date_format:Y-m',
            ],
        ]);

        $muaji = Carbon::createFromFormat(
            'Y-m-d',
            $validated['muaji'] . '-01'
        )->startOfDay();

        DB::transaction(function () use (
            $kontrata,
            $muaji
        ) {

            $kontrata = Kontrata::lockForUpdate()
                ->findOrFail($kontrata->id);

            if ($kontrata->statusi !== 'Aktive') {
                throw ValidationException::withMessages([
                    'muaji' =>
                        'Kontrata nuk lejon gjenerimin e pagave.'
                ]);
            }

            $fundiMuajit = $muaji->copy()->endOfMonth();

            if (
                $fundiMuajit->lt($kontrata->data_fillimit)
                ||
                $muaji->gt($kontrata->data_mbarimit)
            ) {
                throw ValidationException::withMessages([
                    'muaji' =>
                        'Muaji nuk eshte brenda periudhes se kontrates.'
                ]);
            }

            // Ky version gjeneron vetem page te plote mujore.

            if (
                $muaji->lt($kontrata->data_fillimit)
                ||
                $fundiMuajit->copy()->startOfDay()
                    ->gt($kontrata->data_mbarimit)
            ) {
                throw ValidationException::withMessages([
                    'muaji' =>
                        'Kontrata nuk mbulon muajin e plote. Nevojitet llogaritja proporcionale e pages.'
                ]);
            }

            $ekziston = $kontrata->pagesat()
                ->whereDate(
                    'muaji',
                    $muaji->toDateString()
                )
                ->exists();

            if ($ekziston) {
                throw ValidationException::withMessages([
                    'muaji' =>
                        'Paga per kete muaj tashme eshte gjeneruar.'
                ]);
            }

            $kontrata->pagesat()->create([
                'muaji' => $muaji->toDateString(),
                'shuma' => $kontrata->paga_mujore,
                'statusi' => 'Pa paguar',
            ]);

        });

        return back()->with(
            'success',
            'Paga mujore u gjenerua me sukses.'
        );
    }

    public function paguaj(
        Request $request,
        Pagesa $pagesa
    )
    {
        $this->kontrolloLejen($request);

        $validated = $request->validate([

            'data_pageses' => [
                'required',
                'date_format:Y-m-d',
                'before_or_equal:today',
            ],

            'metoda_pageses' => [
                'required',
                Rule::in([
                    'Banke',
                    'Cash',
                ]),
            ],

            'shenime' => [
                'nullable',
                'string',
                'max:5000',
            ],

        ]);

        DB::transaction(function () use (
            $pagesa,
            $validated
        ) {

            $pagesa = Pagesa::lockForUpdate()
                ->findOrFail($pagesa->id);

            if ($pagesa->statusi === 'Paguar') {
                throw ValidationException::withMessages([
                    'pagesa' =>
                        'Kjo page tashme eshte paguar.'
                ]);
            }

            $pagesa->update([
                ...$validated,
                'statusi' => 'Paguar',
            ]);

        });

        return back()->with(
            'success',
            'Pagesa u regjistrua me sukses.'
        );
    }

    public function anuloPagesen(
        Request $request,
        Pagesa $pagesa
    )
    {
        $this->kontrolloLejen($request);

        DB::transaction(function () use ($pagesa) {

            $pagesa = Pagesa::lockForUpdate()
                ->findOrFail($pagesa->id);

            abort_unless(
                $pagesa->statusi === 'Paguar',
                422
            );

            $pagesa->update([
                'statusi' => 'Pa paguar',
                'data_pageses' => null,
                'metoda_pageses' => null,
                'shenime' => null,
            ]);

        });

        return back()->with(
            'success',
            'Regjistrimi i pageses u anulua.'
        );
    }

    public function financatEMia(Request $request)
    {
        $user = $request->user();

        abort_unless(
            in_array(
                $user->role,
                ['coach', 'player', 'manager'],
                true
            ),
            403
        );

        $kontratat = Kontrata::where(
            'user_id',
            $user->id
        )
            ->with('pagesat')
            ->orderByDesc('data_fillimit')
            ->get();

        $pagesat = Pagesa::whereIn(
            'kontrata_id',
            $kontratat->pluck('id')
        )
            ->with('kontrata')
            ->orderByDesc('muaji')
            ->get();

        $totalPaguar = $pagesat
            ->where('statusi', 'Paguar')
            ->sum('shuma');

        $totalPapaguar = $pagesat
            ->where('statusi', 'Pa paguar')
            ->sum('shuma');

        return view('financat.mine', compact(
            'kontratat',
            'pagesat',
            'totalPaguar',
            'totalPapaguar'
        ));
    }
}
