<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    private const ALLOWED_ROLES = [
        'admin',
        'manager',
        'coach',
        'player',
    ];

    public function show()
    {
        return response()
            ->view('login')
            ->header(
                'Cache-Control',
                'no-store, no-cache, must-revalidate, max-age=0'
            )
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function login(Request $request)
    {
        // VALIDIMI

        $validated = $request->validate([

            'email' => [
                'required',
                'email',
                'max:255',
            ],

            'password' => [
                'required',
                'string',
                'max:1024',
            ],

        ], [

            'email.required' =>
                'Shkruaje emailin.',

            'email.email' =>
                'Emaili nuk eshte valid.',

            'password.required' =>
                'Shkruaje fjalekalimin.',

        ]);

        $email = trim($validated['email']);

        // IDENTIFIKIMI I TENTIMEVE

        $emailHash = hash_hmac(
            'sha256',
            Str::lower($email),
            config('app.key')
        );

        $ipHash = hash_hmac(
            'sha256',
            (string) $request->ip(),
            config('app.key')
        );

        // 5 tentime per email + IP

        $loginKey = 'security:login:'
            . $emailHash . ':' . $ipHash;

        // 20 tentime te deshtuara nga e njejta IP

        $ipKey = 'security:login-ip:' . $ipHash;

        // KONTROLLO A ESHTE BLLOKUAR

        if (
            RateLimiter::tooManyAttempts($loginKey, 5)
            ||
            RateLimiter::tooManyAttempts($ipKey, 20)
        ) {

            $seconds = max(

                RateLimiter::tooManyAttempts(
                    $loginKey,
                    5
                )
                    ? RateLimiter::availableIn($loginKey)
                    : 0,

                RateLimiter::tooManyAttempts(
                    $ipKey,
                    20
                )
                    ? RateLimiter::availableIn($ipKey)
                    : 0

            );

            Log::warning('security.login.blocked', [

                'ip' => $request->ip(),

                'email_hash' => $emailHash,

                'retry_after' => $seconds,

            ]);

            throw ValidationException::withMessages([

                'email' =>
                    'Shume tentime te gabuara. Provo perseri pas '
                    . $seconds
                    . ' sekondave.',

            ]);
        }

        // TENTIMI PER LOGIN

        $authenticated = Auth::attempt([

            'email' => $email,

            'password' => $validated['password'],

            'role' => self::ALLOWED_ROLES,

        ], false);

        if (!$authenticated) {

            // Regjistro tentimin e deshtuar

            RateLimiter::hit(
                $loginKey,
                300
            );

            RateLimiter::hit(
                $ipKey,
                900
            );

            Log::warning('security.login.failed', [

                'ip' => $request->ip(),

                'email_hash' => $emailHash,

                'attempts' =>
                    RateLimiter::attempts($loginKey),

            ]);

            $remaining = RateLimiter::remaining(
                $loginKey,
                5
            );

            if ($remaining <= 0) {

                throw ValidationException::withMessages([

                    'email' =>
                        'Shume tentime te gabuara. '
                        . 'Llogaria eshte bllokuar perkohesisht '
                        . 'per kete lidhje. Provo perseri me vone.',

                ]);

            }

            throw ValidationException::withMessages([

                'email' =>
                    'Emaili ose fjalekalimi eshte gabim.',

            ]);
        }

        // LOGIN I SUKSESSHEM

        RateLimiter::clear($loginKey);

        // Mbrojtja kunder Session Fixation

        $request->session()->regenerate();

        $user = Auth::user();

        // Regjistro login-in e suksesshem

        Log::info('security.login.success', [

            'user_id' => $user->id,

            'role' => $user->role,

            'ip' => $request->ip(),

        ]);

        // Mos lejo redirect ne faqe te roleve tjera

        $request->session()->forget('url.intended');

        // RIDREJTIMI SIPAS ROLIT

        return match ($user->role) {

            'admin' =>
            redirect()->route('dashboard'),

            'manager' =>
            redirect()->route('manager.dashboard'),

            'coach' =>
            redirect()->route('coach.dashboard'),

            'player' =>
            redirect()->route('player.dashboard'),

            default =>
            $this->logout($request),

        };
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        if ($user) {

            Log::info('security.logout', [

                'user_id' => $user->id,

                'role' => $user->role,

                'ip' => $request->ip(),

            ]);

        }

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Ke dale me sukses nga sistemi.'
            );
    }
}
