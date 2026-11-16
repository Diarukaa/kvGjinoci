<?php

namespace App\Http\Middleware;

use App\Services\SessionSecurityService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class SecureSession
{
    private const SESSION_KEY =
        'security.session_fingerprint';

    private const ALLOWED_ROLES = [

        'admin',

        'manager',

        'coach',

        'player',

    ];

    public function __construct(
        private SessionSecurityService $security
    ) {
    }

    public function handle(
        Request $request,
        Closure $next
    ): Response {

        $user = $request->user();

        $originalFingerprint = null;

        // KONTROLLO PERDORUESIN E KYÇUR

        if ($user) {

            if (!in_array(
                $user->role,
                self::ALLOWED_ROLES,
                true
            )) {

                return $this->invalidate(
                    $request,
                    'Llogaria jote nuk eshte aktive.'
                );

            }

            if ($this->security->isRevoked(
                $request->session()->getId()
            )) {

                return $this->invalidate(
                    $request,
                    'Ky sesion eshte mbyllur.'
                );

            }

            $originalFingerprint =
                $this->security->fingerprint($user);

            $savedFingerprint = $request
                ->session()
                ->get(self::SESSION_KEY);

            if (
                !is_string($savedFingerprint)
                ||
                !hash_equals(
                    $originalFingerprint,
                    $savedFingerprint
                )
            ) {

                return $this->invalidate(
                    $request,
                    'Sesioni ka skaduar ose eshte ndryshuar. Kyçu perseri.'
                );

            }

        }

        // VAZHDO KERKESEN

        $response = $next($request);

        $currentUser = $request->user();

        // MOS RUAJ FINGERPRINT PAS LOGOUT

        if (!$currentUser) {

            return $response;

        }

        // LOGIN I RI I SUKSESSHEM

        if (
            !$user
            && $request->routeIs('login.store')
        ) {

            $request->session()->put(

                self::SESSION_KEY,

                $this->security->fingerprint(
                    $currentUser
                )

            );

            return $response;

        }

        // PASSWORD CHANGE / LOGOUT OTHER DEVICES

        if (
            $user
            && $request->routeIs(
                'profile.password',
                'profile.sessions.destroyOthers'
            )
        ) {

            $newFingerprint =
                $this->security->fingerprint(
                    $currentUser
                );

            if (
                $originalFingerprint
                && !hash_equals(
                    $originalFingerprint,
                    $newFingerprint
                )
            ) {

                $request->session()->put(

                    self::SESSION_KEY,

                    $newFingerprint

                );

                $this->security->revokeOthers(

                    $currentUser->id,

                    $request->session()->getId()

                );

            }

        }

        return $response;
    }

    private function invalidate(
        Request $request,
        string $message
    ): Response {

        $user = $request->user();

        Log::warning(

            'security.session.invalidated',

            [

                'user_id' => $user?->id,

                'role' => $user?->role,

                'ip' => $request->ip(),

                'reason' => $message,

            ]

        );

        Auth::guard('web')->logoutCurrentDevice();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($request->expectsJson()) {

            return response()->json([

                'message' => $message,

            ], 401);

        }

        return redirect()

            ->route('login')

            ->withErrors([

                'email' => $message,

            ]);
    }
}
