<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\SessionSecurityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function __construct(
        private SessionSecurityService $security
    ) {
    }

    // LISTA E PAJISJEVE AKTIVE

    public function index(Request $request)
    {
        $user = $request->user();

        $sessions = $this->security->devices(

            $user->id,

            $request->session()->getId()

        );

        $otherSessions = $sessions

            ->where('is_current', false)

            ->count();

        return view('profile.sessions', compact(

            'user',

            'sessions',

            'otherSessions'

        ));
    }

    // LARGO NJE PAJISJE SPECIFIKE

    public function destroy(
        Request $request,
        string $device
    ) {

        $request->validate([

            'current_password' => [

                'required',

                'string',

                'max:1024',

                'current_password',

            ],

        ], [

            'current_password.current_password' =>
                'Fjalekalimi aktual eshte gabim.',

        ]);

        $user = $request->user();

        $currentSessionId =
            $request->session()->getId();

        // Merr vetem sesionet e ketij perdoruesi.

        $sessions = $this->security->query()

            ->where('user_id', $user->id)

            ->where('id', '!=', $currentSessionId)

            ->get(['id']);

        $target = $sessions->first(

            fn ($session) => hash_equals(

                $this->security->publicId(
                    $session->id
                ),

                $device

            )

        );

        abort_unless($target, 404);

        $removed = $this->security->revoke(

            $user->id,

            $target->id

        );

        if (!$removed) {

            return back()->withErrors([

                'session' =>
                    'Ky sesion nuk eshte me aktiv.',

            ]);

        }

        Log::info(

            'security.session.revoked',

            [

                'user_id' => $user->id,

                'ip' => $request->ip(),

                'device' => $device,

            ]

        );

        return back()->with(

            'success',

            'Pajisja u largua me sukses nga llogaria.'

        );
    }

    // LARGO TE GJITHA PAJISJET TJERA

    public function destroyOthers(Request $request)
    {
        $validated = $request->validate([

            'current_password' => [

                'required',

                'string',

                'max:1024',

                'current_password',

            ],

        ], [

            'current_password.current_password' =>
                'Fjalekalimi aktual eshte gabim.',

        ]);

        $user = $request->user();

        $newVersion = DB::transaction(

            function () use ($user, $validated) {

                $lockedUser = User::lockForUpdate()

                    ->findOrFail($user->id);

                // Verifiko qe sesioni nuk eshte
                // ndryshuar gjate kesaj kerkese.

                abort_unless(

                    hash_equals(

                        $this->security->fingerprint(
                            $lockedUser
                        ),

                        $this->security->fingerprint(
                            $user
                        )

                    ),

                    401,

                    'Sesioni nuk eshte me valid.'

                );

                if (!Hash::check(

                    $validated['current_password'],

                    $lockedUser->getAuthPassword()

                )) {

                    throw ValidationException
                        ::withMessages([

                            'current_password' =>
                                'Fjalekalimi aktual eshte gabim.',

                        ]);

                }

                // Version i ri per te gjitha
                // sesionet e ardhshme.

                $lockedUser->session_version =

                    (int) $lockedUser->session_version + 1;

                $lockedUser->setRememberToken(

                    Str::random(60)

                );

                $lockedUser->save();

                return $lockedUser->session_version;

            }

        );

        // Pajisja aktuale mbetet e kyçur.

        $user->session_version = $newVersion;

        $request->session()->regenerate(true);

        // SecureSession perditeson fingerprint-in
        // dhe largon sesionet tjera nga databaza.

        Log::info(

            'security.sessions.revoked_others',

            [

                'user_id' => $user->id,

                'ip' => $request->ip(),

            ]

        );

        return back()->with(

            'success',

            'Te gjitha pajisjet tjera u larguan nga llogaria.'

        );
    }
}
