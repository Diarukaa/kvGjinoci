<?php

namespace App\Observers;

use App\Models\Kontrata;
use App\Services\ClubNotificationService;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class KontrataObserver implements ShouldHandleEventsAfterCommit
{
    public function __construct(
        private ClubNotificationService $notifications
    ) {
    }

    public function created(Kontrata $kontrata): void
    {
        $this->notifications->notifyUser(
            $kontrata->user_id,
            'Kontrate e re',
            'Nje kontrate e re eshte regjistruar. '
            . 'Mund ta shikosh te Financat e Mia.',
            'kontrate',
            route('financat.mine', [], false)
        );
    }
}
