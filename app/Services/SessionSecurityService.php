<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SessionSecurityService
{
    public function fingerprint(User $user): string
    {
        return hash_hmac(

            'sha256',

            json_encode([

                'id' => $user->id,

                'password' =>
                    $user->getAuthPassword(),

                'role' => $user->role,

                'version' =>
                    (int) $user->session_version,

            ], JSON_THROW_ON_ERROR),

            config('app.key')

        );
    }

    public function query()
    {
        abort_unless(

            config('session.driver') === 'database',

            503,

            'Session driver duhet te jete database.'

        );

        return DB::connection(
            config('session.connection')
        )->table(
            config('session.table', 'sessions')
        );
    }

    // ID publike pa ekspozuar session ID reale

    public function publicId(string $sessionId): string
    {
        return hash_hmac(

            'sha256',

            $sessionId,

            config('app.key')

        );
    }

    private function revokedKey(
        string $sessionId
    ): string {

        return 'security:revoked-session:'
            . $this->publicId($sessionId);

    }

    public function isRevoked(
        string $sessionId
    ): bool {

        return Cache::has(
            $this->revokedKey($sessionId)
        );

    }

    public function revoke(
        int $userId,
        string $sessionId
    ): bool {

        $exists = $this->query()
            ->where('user_id', $userId)
            ->where('id', $sessionId)
            ->exists();

        if (!$exists) {
            return false;
        }

        // Mbrojtje shtese ndaj kerkesave
        // qe jane ende duke u ekzekutuar.

        Cache::put(

            $this->revokedKey($sessionId),

            true,

            now()->addMinutes(
                (int) config('session.lifetime', 30)
                + 5
            )

        );

        $this->query()
            ->where('user_id', $userId)
            ->where('id', $sessionId)
            ->delete();

        return true;
    }

    public function revokeOthers(
        int $userId,
        string $currentSessionId
    ): int {

        $sessionIds = $this->query()

            ->where('user_id', $userId)

            ->where('id', '!=', $currentSessionId)

            ->pluck('id');

        $count = 0;

        foreach ($sessionIds as $sessionId) {

            if ($this->revoke(
                $userId,
                $sessionId
            )) {

                $count++;

            }

        }

        return $count;
    }

    public function devices(
        int $userId,
        string $currentSessionId
    ) {

        $cutoff = now()

            ->subMinutes(
                (int) config('session.lifetime', 30)
            )

            ->timestamp;

        return $this->query()

            ->where('user_id', $userId)

            ->where('last_activity', '>=', $cutoff)

            ->orderByDesc('last_activity')

            ->get([

                'id',

                'ip_address',

                'user_agent',

                'last_activity',

            ])

            ->map(function ($session) use (
                $currentSessionId
            ) {

                return [

                    'id' => $this->publicId(
                        $session->id
                    ),

                    'ip' =>
                        $session->ip_address ?? '-',

                    'device' => $this->deviceName(
                        $session->user_agent
                    ),

                    'browser' => $this->browserName(
                        $session->user_agent
                    ),

                    'last_activity' =>
                        \Carbon\Carbon::createFromTimestamp(
                            $session->last_activity,
                            config('app.timezone')
                        ),

                    'is_current' => hash_equals(
                        $currentSessionId,
                        $session->id
                    ),

                ];
            });
    }

    private function deviceName(
        ?string $agent
    ): string {

        $agent = $agent ?? '';

        return match (true) {

            str_contains($agent, 'iPhone') =>
            'iPhone',

            str_contains($agent, 'iPad') =>
            'iPad',

            str_contains($agent, 'Android') =>
            'Android',

            str_contains($agent, 'Windows') =>
            'Windows PC',

            str_contains($agent, 'Macintosh') =>
            'Mac',

            str_contains($agent, 'Linux') =>
            'Linux',

            default => 'Pajisje e panjohur',

        };
    }

    private function browserName(
        ?string $agent
    ): string {

        $agent = $agent ?? '';

        return match (true) {

            str_contains($agent, 'Edg') =>
            'Microsoft Edge',

            str_contains($agent, 'OPR') =>
            'Opera',

            str_contains($agent, 'Firefox'),
            str_contains($agent, 'FxiOS') =>
            'Firefox',

            str_contains($agent, 'Chrome'),
            str_contains($agent, 'CriOS') =>
            'Google Chrome',

            str_contains($agent, 'Safari') =>
            'Safari',

            default => 'Browser i panjohur',

        };
    }
}
