<?php

namespace App\Observers;

use App\Models\Ndeshja;
use App\Services\ClubNotificationService;
use Carbon\Carbon;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class NdeshjaObserver implements ShouldHandleEventsAfterCommit
{
    public function __construct(
        private ClubNotificationService $notifications
    ) {
    }

    public function created(Ndeshja $ndeshja): void
    {
        if ($ndeshja->statusi === 'Perfunduar') {
            $this->njoftoRezultatin($ndeshja);
            return;
        }

        if ($ndeshja->statusi !== 'Planifikuar') {
            return;
        }

        $data = Carbon::parse(
            $ndeshja->data_ndeshjes
        )->format('d.m.Y H:i');

        $this->notifications->notifyTeam(
            $ndeshja->ekipi_id,
            'Ndeshje e re',
            "Eshte planifikuar ndeshja kunder "
            . $ndeshja->kundershtari
            . " me date " . $data . ".",
            'ndeshje'
        );
    }

    public function updated(Ndeshja $ndeshja): void
    {
        if (
            $ndeshja->statusi === 'Perfunduar'
            && $ndeshja->wasChanged([
                'statusi',
                'setet_tona',
                'setet_kundershtarit'
            ])
        ) {
            $this->njoftoRezultatin($ndeshja);
            return;
        }

        if ($ndeshja->statusi !== 'Planifikuar') {
            return;
        }

        if ($ndeshja->wasChanged([
            'data_ndeshjes',
            'palestra',
            'lokacioni',
            'kundershtari',
            'ekipi_id',
            'statusi'
        ])) {

            $data = Carbon::parse(
                $ndeshja->data_ndeshjes
            )->format('d.m.Y H:i');

            $this->notifications->notifyTeam(
                $ndeshja->ekipi_id,
                'Ndryshim ne ndeshje',
                "Ndeshja kunder "
                . $ndeshja->kundershtari
                . " eshte perditesuar. Orari: "
                . $data . ".",
                'ndeshje'
            );
        }
    }

    private function njoftoRezultatin(
        Ndeshja $ndeshja
    ): void {

        $rezultati = $ndeshja->setet_tona
            . ':'
            . $ndeshja->setet_kundershtarit;

        $this->notifications->notifyTeam(
            $ndeshja->ekipi_id,
            'Rezultati i ndeshjes',
            "Ndeshja kunder "
            . $ndeshja->kundershtari
            . " ka perfunduar "
            . $rezultati . ".",
            'rezultat'
        );
    }
}
