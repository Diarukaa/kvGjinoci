<?php

namespace App\Http\Controllers;

use App\Models\FormacionPozicioni;
use App\Models\Lojtar;
use App\Models\Ndeshja;
use Illuminate\Http\Request;

class FormacionPrintController extends Controller
{
    public function index(
        Request $request,
        Ndeshja $ndeshja
    ) {
        $user = $request->user();

        abort_unless($user, 401);

        $ndeshja->load('ekipi');

        abort_unless($ndeshja->ekipi, 404);

        // Kontrollo rolin dhe ekipin.

        if ($user->role === 'coach') {

            abort_unless(
                $user->trajner_id
                && (int) $ndeshja->ekipi->trajner_id
                === (int) $user->trajner_id,
                403,
                'Nuk ke qasje ne kete ndeshje.'
            );

        } else {

            abort_unless(
                in_array(
                    $user->role,
                    ['admin', 'manager'],
                    true
                ),
                403
            );

        }

        // Merr te gjitha pozicionet e ruajtura.

        $pozicionet = FormacionPozicioni::query()
            ->where('ndeshja_id', $ndeshja->id)
            ->whereBetween('seti', [1, 5])
            ->whereBetween('pozicioni', [1, 7])
            ->orderBy('seti')
            ->orderBy('pozicioni')
            ->get();

        // Merr vetem lojtaret qe figurojne
        // ne kete raport dhe i takojne ekipit.

        $lojtaret = Lojtar::query()
            ->where('ekipi_id', $ndeshja->ekipi_id)
            ->whereIn(
                'id',
                $pozicionet->pluck('lojtar_id')->unique()
            )
            ->get()
            ->keyBy('id');

        $formacionet = [];

        foreach (range(1, 5) as $seti) {

            $rreshtat = $pozicionet
                ->where('seti', $seti);

            if ($rreshtat->isEmpty()) {
                continue;
            }

            $formacioni = [];

            foreach ($rreshtat as $pozicion) {

                $lojtar = $lojtaret->get(
                    $pozicion->lojtar_id
                );

                // Nese lojtari eshte transferuar
                // ne ekip tjeter, mos i ekspozo
                // te dhenat e ekipit tjeter.

                if (!$lojtar) {
                    continue;
                }

                $numri = $lojtar->getAttribute(
                    'numriFanelles'
                );

                if ($numri === null || $numri === '') {

                    foreach ([
                                 'numri_fanelles',
                                 'numri_faneles',
                                 'jersey_number',
                             ] as $fushe) {

                        $value = $lojtar->getAttribute(
                            $fushe
                        );

                        if ($value !== null && $value !== '') {
                            $numri = $value;
                            break;
                        }
                    }
                }

                $formacioni[$pozicion->pozicioni] = [
                    'emri' => trim(
                        $lojtar->emri . ' ' .
                        $lojtar->mbiemri
                    ),
                    'numri' => (
                        $numri !== null && $numri !== ''
                    ) ? (string) $numri : '–',
                ];
            }

            if (!empty($formacioni)) {

                $formacionet[$seti] = $formacioni;

            }
        }

        return response()
            ->view('formacionet.print-all', [
                'ndeshja' => $ndeshja,
                'formacionet' => $formacionet,
            ])
            ->header(
                'Cache-Control',
                'private, no-store'
            );
    }
}
