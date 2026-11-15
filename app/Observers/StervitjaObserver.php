<?php

namespace App\Observers;

use App\Models\Stervitja;
use App\Services\ClubNotificationService;
use Carbon\Carbon;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class StervitjaObserver implements ShouldHandleEventsAfterCommit
{
    public function __construct(
        private ClubNotificationService $notifications
    ) {
    }

    public function created(Stervitja $stervitja): void
    {
        if ($stervitja->statusi !== 'Planifikuar') {
            return;
        }

        $this->njoftoStervitjen(
            $stervitja,
            'Stervitje e re'
        );
    }

    public function updated(Stervitja $stervitja): void
    {
        if (
            $stervitja->wasChanged('statusi')
            && $stervitja->statusi === 'Anuluar'
        ) {

            $data = Carbon::parse(
                $stervitja->data
            )->format('d.m.Y');

            $this->notifications->notifyTeam(
                $stervitja->ekipi_id,
                'Stervitja eshte anuluar',
                "Stervitja e dates "
                . $data
                . " eshte anuluar.",
                'stervitje'
            );

            return;
        }

        if ($stervitja->statusi !== 'Planifikuar') {
            return;
        }

        if ($stervitja->wasChanged([
            'data',
            'ora_fillimit',
            'ora_mbarimit',
            'palestra',
            'lloji',
            'ekipi_id',
            'statusi'
        ])) {

            $this->njoftoStervitjen(
                $stervitja,
                'Ndryshim i stervitjes'
            );
        }
    }

    private function njoftoStervitjen(
        Stervitja $stervitja,
        string $titulli
    ): void {

        $data = Carbon::parse(
            $stervitja->data
        )->format('d.m.Y');

        $ora = substr(
            (string) $stervitja->ora_fillimit,
            0,
            5
        );

        $palestra = $stervitja->palestra
            ?? 'Palestra e klubit';

        $this->notifications->notifyTeam(
            $stervitja->ekipi_id,
            $titulli,
            "Stervitja eshte planifikuar me "
            . $data
            . " ne ora "
            . $ora
            . ". Lokacioni: "
            . $palestra . ".",
            'stervitje'
        );
    }
}
