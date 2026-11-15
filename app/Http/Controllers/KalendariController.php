<?php

namespace App\Http\Controllers;

use App\Models\Ekipi;
use App\Models\Ndeshja;
use App\Models\Stervitja;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class KalendariController extends Controller
{
    private function ekipetELjuara(Request $request)
    {
        $user = $request->user();

        $query = Ekipi::query();

        switch ($user->role) {

            case 'admin':
            case 'manager':
                break;

            case 'coach':

                if (!$user->trajner) {
                    $query->whereRaw('1 = 0');
                    break;
                }

                $query->where(
                    'trajner_id',
                    $user->trajner->id
                );

                break;

            case 'player':

                if (!$user->lojtar?->ekipi_id) {
                    $query->whereRaw('1 = 0');
                    break;
                }

                $query->where(
                    'id',
                    $user->lojtar->ekipi_id
                );

                break;

            default:
                abort(403);
        }

        return $query->orderBy('emri')->get();
    }

    public function index(Request $request)
    {
        $ekipet = $this->ekipetELjuara($request);

        return view('kalendari.index', compact('ekipet'));
    }

    public function events(Request $request)
    {
        $ekipet = $this->ekipetELjuara($request);

        $ekipetIds = $ekipet->pluck('id');

        $validated = $request->validate([

            'start' => [
                'required',
                'date',
            ],

            'end' => [
                'required',
                'date',
                'after:start',
            ],

            'ekipi_id' => [
                'nullable',
                'integer',
                Rule::in($ekipetIds->all()),
            ],

            'lloji' => [
                'nullable',
                Rule::in([
                    'all',
                    'ndeshje',
                    'stervitje',
                ]),
            ],

        ]);

        $fillimi = Carbon::parse($validated['start']);

        $fundi = Carbon::parse($validated['end']);

        if ($fundi->gt($fillimi->copy()->addDays(62))) {

            throw ValidationException::withMessages([
                'end' => 'Zgjedh nje periudhe me te shkurter.'
            ]);

        }

        $ekipiId = $validated['ekipi_id'] ?? null;

        $lloji = $validated['lloji'] ?? 'all';

        $role = $request->user()->role;

        $events = [];

        // NDESHJET

        if (in_array($lloji, ['all', 'ndeshje'])) {

            $ndeshjet = Ndeshja::with('ekipi')
                ->whereIn('ekipi_id', $ekipetIds)
                ->when(
                    $ekipiId,
                    fn ($query) => $query->where(
                        'ekipi_id',
                        $ekipiId
                    )
                )
                ->where(
                    'data_ndeshjes',
                    '>=',
                    $fillimi->format('Y-m-d H:i:s')
                )
                ->where(
                    'data_ndeshjes',
                    '<',
                    $fundi->format('Y-m-d H:i:s')
                )
                ->get();

            foreach ($ndeshjet as $ndeshja) {

                $data = Carbon::parse(
                    $ndeshja->data_ndeshjes
                );

                $ekipi = $ndeshja->ekipi?->emri ?? '-';

                $rezultati = null;

                if ($ndeshja->statusi === 'Perfunduar') {

                    $rezultati =
                        $ndeshja->setet_tona
                        . ':'
                        . $ndeshja->setet_kundershtarit;

                }

                $ngjyra = match($ndeshja->statusi) {

                    'Anuluar' => '#dc2626',

                    'Perfunduar' => '#1e40af',

                    default => '#3b82f6',

                };

                $editUrl = match($role) {

                    'admin', 'manager' => route(
                        'ndeshjet.edit',
                        $ndeshja
                    ),

                    'coach' => route(
                        'coach.ndeshjet.edit',
                        $ndeshja
                    ),

                    default => null,

                };

                $events[] = [

                    'id' => 'ndeshje-' . $ndeshja->id,

                    'title' =>
                        $ekipi
                        . ' vs '
                        . $ndeshja->kundershtari
                        . ($rezultati
                            ? ' (' . $rezultati . ')'
                            : ''),

                    'start' => $data->format(
                        'Y-m-d\TH:i:s'
                    ),

                    'allDay' => false,

                    'backgroundColor' => $ngjyra,

                    'borderColor' => $ngjyra,

                    'extendedProps' => [

                        'lloji' => 'Ndeshje',

                        'ekipi' => $ekipi,

                        'kundershtari' =>
                            $ndeshja->kundershtari,

                        'palestra' =>
                            $ndeshja->palestra ?? '-',

                        'lokacioni' =>
                            $ndeshja->lokacioni ?? '-',

                        'statusi' => $ndeshja->statusi,

                        'data' => $data->format('d.m.Y'),

                        'ora' => $data->format('H:i'),

                        'rezultati' => $rezultati,

                        'editUrl' => $editUrl,

                    ],

                ];
            }
        }

        // STERVITJET

        if (in_array($lloji, ['all', 'stervitje'])) {

            $stervitjet = Stervitja::with('ekipi')
                ->whereIn('ekipi_id', $ekipetIds)
                ->when(
                    $ekipiId,
                    fn ($query) => $query->where(
                        'ekipi_id',
                        $ekipiId
                    )
                )
                ->whereDate(
                    'data',
                    '>=',
                    $fillimi->toDateString()
                )
                ->whereDate(
                    'data',
                    '<',
                    $fundi->toDateString()
                )
                ->get();

            foreach ($stervitjet as $stervitja) {

                $data = Carbon::parse(
                    $stervitja->data
                )->toDateString();

                $oraFillimit = substr(
                    (string) $stervitja->ora_fillimit,
                    0,
                    5
                );

                $oraMbarimit = substr(
                    (string) $stervitja->ora_mbarimit,
                    0,
                    5
                );

                $start = Carbon::parse(
                    $data . ' ' . $oraFillimit
                );

                $end = Carbon::parse(
                    $data . ' ' . $oraMbarimit
                );

                $ekipi = $stervitja->ekipi?->emri ?? '-';

                $ngjyra = match($stervitja->statusi) {

                    'Anuluar' => '#dc2626',

                    'Perfunduar' => '#166534',

                    default => '#16a34a',

                };

                $editUrl = match($role) {

                    'admin', 'manager' => route(
                        'stervitjet.edit',
                        $stervitja
                    ),

                    'coach' => route(
                        'coach.stervitjet.edit',
                        $stervitja
                    ),

                    default => null,

                };

                $events[] = [

                    'id' => 'stervitje-' . $stervitja->id,

                    'title' =>
                        $ekipi
                        . ' - '
                        . ($stervitja->lloji ?? 'Stervitje'),

                    'start' => $start->format(
                        'Y-m-d\TH:i:s'
                    ),

                    'end' => $end->gt($start)
                        ? $end->format('Y-m-d\TH:i:s')
                        : null,

                    'allDay' => false,

                    'backgroundColor' => $ngjyra,

                    'borderColor' => $ngjyra,

                    'extendedProps' => [

                        'lloji' => 'Stervitje',

                        'ekipi' => $ekipi,

                        'palestra' =>
                            $stervitja->palestra ?? '-',

                        'statusi' => $stervitja->statusi,

                        'data' => $start->format('d.m.Y'),

                        'ora' =>
                            $oraFillimit
                            . ' - '
                            . $oraMbarimit,

                        'pershkrimi' =>
                            $stervitja->pershkrimi ?? '',

                        'editUrl' => $editUrl,

                    ],

                ];
            }
        }

        return response()->json($events);
    }
}
