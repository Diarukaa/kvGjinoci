<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Throwable;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user()->load([
            'trajner',
            'lojtar',
            'manager'
        ]);

        $profile = match ($user->role) {
            'coach' => $user->trajner,
            'player' => $user->lojtar,
            'manager' => $user->manager,
            default => null,
        };

        return view('profile.index', compact(
            'user',
            'profile'
        ));
    }

    // INFORMACIONET PERSONALE

    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')
                    ->ignore($user->id),
            ],

            'current_password' => [
                'required',
                'current_password',
            ],

        ], [
            'email.unique' =>
                'Ky email eshte ne perdorim.',

            'current_password.current_password' =>
                'Fjalekalimi aktual eshte gabim.',
        ]);

        $user->name = $validated['name'];

        if ($user->email !== $validated['email']) {

            $user->email = $validated['email'];

            $user->email_verified_at = null;

        }

        $user->save();

        return back()->with(
            'success',
            'Informacionet personale u perditesuan.'
        );
    }

    // NDRYSHIMI I PASSWORDIT

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([

            'current_password' => [
                'required',
                'current_password',
            ],

            'password' => [
                'required',
                'string',
                'confirmed',
                'different:current_password',
                Password::min(8)
                    ->letters()
                    ->numbers(),
            ],

        ], [
            'current_password.current_password' =>
                'Fjalekalimi aktual eshte gabim.',

            'password.confirmed' =>
                'Fjalekalimet nuk perputhen.',

            'password.different' =>
                'Fjalekalimi i ri duhet te jete ndryshe.',
        ]);

        $user = $request->user();

        $user->password = Hash::make(
            $validated['password']
        );

        $user->setRememberToken(
            \Illuminate\Support\Str::random(60)
        );

        $user->save();

        $request->session()->regenerate();

        return back()->with(
            'success',
            'Fjalekalimi u ndryshua me sukses.'
        );
    }

    // NGARKIMI I FOTOS

    public function updatePhoto(Request $request)
    {
        $request->validate([

            'photo' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
                'dimensions:min_width=100,min_height=100,max_width=4000,max_height=4000',
            ],

        ], [
            'photo.required' =>
                'Zgjedh nje foto.',

            'photo.image' =>
                'Fajlli duhet te jete nje foto.',

            'photo.max' =>
                'Fotoja nuk duhet te jete me e madhe se 2 MB.',

            'photo.dimensions' =>
                'Fotoja duhet te jete nga 100x100 deri ne 4000x4000 piksele.',
        ]);

        $path = $request->file('photo')
            ->store('profile-photos', 'local');

        abort_unless($path, 500);

        try {

            $oldPath = DB::transaction(
                function () use ($request, $path) {

                    $user = \App\Models\User::lockForUpdate()
                        ->findOrFail(
                            $request->user()->id
                        );

                    $oldPath = $user->profile_photo;

                    $user->profile_photo = $path;

                    $user->save();

                    return $oldPath;
                }
            );

        } catch (Throwable $exception) {

            Storage::disk('local')->delete($path);

            throw $exception;
        }

        if ($oldPath) {

            Storage::disk('local')->delete($oldPath);

        }

        return back()->with(
            'success',
            'Fotoja e profilit u perditesua.'
        );
    }

    // SHFAQJA E FOTOS PERSONALE

    public function photo(Request $request)
    {
        $path = $request->user()->profile_photo;

        abort_unless(
            $path && Storage::disk('local')->exists($path),
            404
        );

        return Storage::disk('local')->response(
            $path,
            null,
            [
                'Cache-Control' => 'private, no-store',
                'X-Content-Type-Options' => 'nosniff',
            ]
        );
    }

    // LARGIMI I FOTOS

    public function destroyPhoto(Request $request)
    {
        $path = DB::transaction(
            function () use ($request) {

                $user = \App\Models\User::lockForUpdate()
                    ->findOrFail(
                        $request->user()->id
                    );

                $path = $user->profile_photo;

                $user->profile_photo = null;

                $user->save();

                return $path;
            }
        );

        if ($path) {

            Storage::disk('local')->delete($path);

        }

        return back()->with(
            'success',
            'Fotoja e profilit u largua.'
        );
    }
}
