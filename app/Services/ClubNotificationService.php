<?php

namespace App\Services;

use App\Models\User;
use App\Models\Lojtar;
use App\Notifications\ClubNotification;
use Illuminate\Support\Facades\Notification;

class ClubNotificationService
{
    public function notifyTeam(
        int $ekipiId,
        string $titulli,
        string $mesazhi,
        string $lloji = 'ndeshje'
    ): void {

        $lojtarIds = Lojtar::where(
            'ekipi_id',
            $ekipiId
        )->pluck('id');

        $users = User::where('role', 'player')
            ->whereIn('lojtar_id', $lojtarIds)
            ->get();

        Notification::send(
            $users,
            new ClubNotification(
                $titulli,
                $mesazhi,
                $lloji,
                route('player.dashboard', [], false)
            )
        );
    }

    public function notifyUser(
        int $userId,
        string $titulli,
        string $mesazhi,
        string $lloji = 'informacion',
        ?string $url = null
    ): void {

        $user = User::find($userId);

        if (!$user || $user->role === 'pending') {
            return;
        }

        $user->notify(
            new ClubNotification(
                $titulli,
                $mesazhi,
                $lloji,
                $url ?? route('dashboard', [], false)
            )
        );
    }
}
