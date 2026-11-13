<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // LISTA E PERDORUESVE
    public function index(Request $request)
    {
        $search = $request->get('search');

        $users = User::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $totalUsers = User::count();

        $totalAdmins = User::where('role', 'admin')->count();

        $totalManagers = User::where('role', 'manager')->count();

        $totalCoaches = User::where('role', 'coach')->count();

        $totalPlayers = User::where('role', 'player')->count();

        $totalPending = User::where('role', 'pending')->count();

        return view('users.index', compact(
            'users',
            'search',
            'totalUsers',
            'totalAdmins',
            'totalManagers',
            'totalCoaches',
            'totalPlayers',
            'totalPending'
        ));
    }

    // FORMULARI PER USER TE RI
    public function create()
    {
        return view('users.create');
    }

    // RUAJ USERIN
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email'
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed'
            ],

            'role' => [
                'required',
                Rule::in([
                    'admin',
                    'manager',
                    'coach',
                    'player',
                    'pending'
                ])
            ],
        ]);

        $user = new User();

        $user->name = $validated['name'];

        $user->email = $validated['email'];

        $user->password = Hash::make(
            $validated['password']
        );

        $user->role = $validated['role'];

        $user->save();

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'Perdoruesi u krijua me sukses.'
            );
    }

    // EDITO USERIN
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // RUAJ NDRYSHIMET
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')
                    ->ignore($user->id)
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed'
            ],

            'role' => [
                'required',
                Rule::in([
                    'admin',
                    'manager',
                    'coach',
                    'player',
                    'pending'
                ])
            ],
        ]);

        // Admini nuk mund ta largoje rolin e vet
        if (
            $user->id === auth()->id()
            && $validated['role'] !== 'admin'
        ) {
            return back()
                ->withErrors([
                    'role' => 'Nuk mund ta ndryshosh rolin e llogarise tende.'
                ])
                ->withInput();
        }

        // Mbrojtja nga ndryshimi i administratorit te fundit
        if (
            $user->role === 'admin'
            && $validated['role'] !== 'admin'
            && User::where('role', 'admin')->count() <= 1
        ) {
            return back()
                ->withErrors([
                    'role' => 'Sistemi duhet te kete se paku nje administrator.'
                ])
                ->withInput();
        }

        $user->name = $validated['name'];

        $user->email = $validated['email'];

        $user->role = $validated['role'];

        // Passwordi ndryshon vetem nese eshte plotesuar
        if (!empty($validated['password'])) {
            $user->password = Hash::make(
                $validated['password']
            );
        }

        $user->save();

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'Perdoruesi u perditesua me sukses.'
            );
    }

    // FSHI USERIN
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with(
                'error',
                'Nuk mund ta fshish llogarine tende.'
            );
        }

        if (
            $user->role === 'admin'
            && User::where('role', 'admin')->count() <= 1
        ) {
            return back()->with(
                'error',
                'Nuk mund ta fshish administratorin e fundit.'
            );
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'Perdoruesi u fshi me sukses.'
            );
    }
}
