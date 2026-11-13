<?php

namespace App\Http\Controllers;

use App\Models\Ekipi;
use App\Models\Lojtar;
use App\Models\Ndeshja;
use App\Models\Stervitja;
use App\Models\StatistikaLojtarit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CoachSportController extends Controller
{
    private function ekipetIds(Request $request)
    {
        abort_unless($request->user()->role === 'coach', 403);

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
        $ekipetIds = $this->ekipetIds($request);

        abort_unless(
            $ekipetIds->contains($ndeshja->ekipi_id),
            403,
            'Nuk ke leje per kete ndeshje.'
        );
    }

    public function ndeshjet(Request $request)
    {
        $ekipetIds = $this->ekipetIds($request);

        $ndeshjet = Ndeshja::with('ekipi')
            ->whereIn('ekipi_id', $ekipetIds)
            ->orderByDesc('data_ndeshjes')
            ->get();

        return view(
            'coach.ndeshjet',
            compact('ndeshjet')
        );
    }

    public function statistikat(
        Request $request,
        Ndeshja $ndeshja
    )
    {
        $this->kontrolloNdeshjen(
            $request,
            $ndeshja
        );

        $ndeshja->load('ekipi');

        $lojtaret = Lojtar::where(
            'ekipi_id',
            $ndeshja->ekipi_id
        )->orderBy('emri')->get();

        $statistikat = StatistikaLojtarit::where(
            'ndeshja_id',
            $ndeshja->id
        )->get()->keyBy('lojtar_id');

        return view(
            'coach.statistikat',
            compact(
                'ndeshja',
                'lojtaret',
                'statistikat'
            )
        );
    }

    public function ruajStatistikat(
        Request $request,
        Ndeshja $ndeshja
    )
    {
        $this->kontrolloNdeshjen(
            $request,
            $ndeshja
        );

        abort_unless(
            $ndeshja->statusi === 'Perfunduar',
            422,
            'Ndeshja duhet te jete e perfunduar.'
        );

        $validated = $request->validate([
            'lojtar_id' => [
                'required',
                'integer',
                Rule::exists(
                    (new Lojtar())->getTable(),
                    'id'
                )->where(
                    'ekipi_id',
                    $ndeshja->ekipi_id
                ),
            ],

            'kills' => ['required', 'integer', 'min:0', 'max:999'],
            'aces' => ['required', 'integer', 'min:0', 'max:999'],
            'blocks' => ['required', 'integer', 'min:0', 'max:999'],
            'digs' => ['required', 'integer', 'min:0', 'max:999'],
        ]);

        $statistika = StatistikaLojtarit::firstOrNew([
            'ndeshja_id' => $ndeshja->id,
            'lojtar_id' => $validated['lojtar_id'],
        ]);

        $statistika->ndeshja_id = $ndeshja->id;
        $statistika->lojtar_id = $validated['lojtar_id'];
        $statistika->kills = $validated['kills'];
        $statistika->aces = $validated['aces'];
        $statistika->blocks = $validated['blocks'];
        $statistika->digs = $validated['digs'];

        $statistika->save();

        return back()->with(
            'success',
            'Statistikat u ruajten me sukses.'
        );
    }

    public function fshiStatistikat(
        Request $request,
        Ndeshja $ndeshja,
        StatistikaLojtarit $statistika
    )
    {
        $this->kontrolloNdeshjen(
            $request,
            $ndeshja
        );

        abort_unless(
            (int) $statistika->ndeshja_id === (int) $ndeshja->id,
            404
        );

        abort_unless(
            $ndeshja->statusi === 'Perfunduar',
            422,
            'Ndeshja duhet te jete e perfunduar.'
        );

        abort_unless(
            Lojtar::where('id', $statistika->lojtar_id)
                ->where('ekipi_id', $ndeshja->ekipi_id)
                ->exists(),
            403
        );

        $statistika->delete();

        return back()->with(
            'success',
            'Statistikat u fshine me sukses.'
        );
    }

    public function stervitjet(Request $request)
    {
        $ekipetIds = $this->ekipetIds($request);

        $stervitjet = Stervitja::with('ekipi')
            ->whereIn('ekipi_id', $ekipetIds)
            ->orderByDesc('data')
            ->get();

        return view(
            'coach.stervitjet',
            compact('stervitjet')
        );
    }
}
