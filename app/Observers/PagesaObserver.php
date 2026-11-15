<?php

namespace App\Observers;

use App\Models\Pagesa;
use App\Services\ClubNotificationService;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class PagesaObserver implements ShouldHandleEventsAfterCommit
{
    public function __construct(
        private ClubNotificationService $notifications
    ) {
    }

    public function updated(Pagesa $pagesa): void
    {
        if (!$pagesa->wasChanged('statusi')) {
            return;
        }

        $kontrata = $pagesa->kontrata;

        if (!$kontrata) {
            return;
        }

        $muaji = $pagesa->muaji->format('m/Y');

        if ($pagesa->statusi === 'Paguar') {

            $this->notifications->notifyUser(
                $kontrata->user_id,
                'Paga eshte paguar',
                "Pagesa per muajin "
                . $muaji
                . " eshte regjistruar si e paguar.",
                'pagese',
                route('financat.mine', [], false)
            );

        } elseif ($pagesa->statusi === 'Pa paguar') {

            $this->notifications->notifyUser(
                $kontrata->user_id,
                'Perditesim i pageses',
                "Statusi i pageses per muajin "
                . $muaji
                . " eshte ndryshuar. "
                . "Kontrollo Financat e Mia.",
                'pagese',
                route('financat.mine', [], false)
            );
        }
    }
}
