<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Trajner;
use App\Models\Lojtar;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    private function kontrolloAdminin(): void
    {
        abort_unless(
            auth()->user()?->role === 'admin',
            403
        );
    }

    public function index()
    {
        $this->kontrolloAdminin();

        $users = User::with([
            'trajner',
            'lojtar',
            'manager'
        ])->latest()->paginate(15);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $this->kontrolloAdminin();

        $user = new User();

        return view(
            'users.create',
            $this->formData($user)
        );
    }

    public function store(Request $request)
    {
        $this->kontrolloAdminin();

        DB::transaction(function () use ($request) {

            $validated = $this->validimi($request);

            $user = new User();

            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->password = $validated['password'];
            $user->role = $validated['role'];

            $this->lidheProfilin($user, $validated);

            $user->save();

        });

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'Perdoruesi u krijua me sukses.'
            );
    }

    public function edit(User $user)
    {
        $this->kontrolloAdminin();

        return view(
            'users.edit',
            $this->formData($user)
        );
    }

    public function update(Request $request, User $user)
    {
        $this->kontrolloAdminin();

        DB::transaction(function () use ($request, $user) {

            // Kontrollo administratorët para ndryshimit
            $adminet = User::where('role', 'admin')
                ->orderBy('id')
                ->lockForUpdate()
                ->get();

            $user = User::lockForUpdate()
                ->findOrFail($user->id);

            $validated = $this->validimi(
                $request,
                $user
            );

            if (
                $user->id === auth()->id() &&
                $validated['role'] !== 'admin'
            ) {
                throw ValidationException::withMessages([
                    'role' =>
                        'Nuk mund ta ndryshosh rolin e llogarise tende.'
                ]);
            }

            if (
                $user->role === 'admin' &&
                $validated['role'] !== 'admin' &&
                $adminet->count() <= 1
            ) {
                throw ValidationException::withMessages([
                    'role' =>
                        'Sistemi duhet te kete te pakten nje administrator.'
                ]);
            }

            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->role = $validated['role'];

            if (!empty($validated['password'])) {
                $user->password = $validated['password'];
            }

            $this->lidheProfilin($user, $validated);

            $user->save();

        });

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'Perdoruesi u perditesua me sukses.'
            );
    }

    public function destroy(User $user)
    {
        $this->kontrolloAdminin();

        DB::transaction(function () use ($user) {

            $adminet = User::where('role', 'admin')
                ->orderBy('id')
                ->lockForUpdate()
                ->get();

            $user = User::lockForUpdate()
                ->findOrFail($user->id);

            if ($user->id === auth()->id()) {
                throw ValidationException::withMessages([
                    'user' =>
                        'Nuk mund ta fshish llogarine tende.'
                ]);
            }

            if (
                $user->role === 'admin' &&
                $adminet->count() <= 1
            ) {
                throw ValidationException::withMessages([
                    'user' =>
                        'Nuk mund ta fshish administratorin e fundit.'
                ]);
            }

            $user->delete();

        });

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'Perdoruesi u fshi me sukses.'
            );
    }

    private function formData(User $user): array
    {
        // Profilet e lidhura me llogari tjera

        $perdoruesit = User::query()
            ->when(
                $user->exists,
                fn ($query) => $query->where(
                    'id',
                    '!=',
                    $user->id
                )
            )
            ->get([
                'trajner_id',
                'lojtar_id',
                'manager_id'
            ]);

        $trajneret = Trajner::whereNotIn(
            'id',
            $perdoruesit->pluck('trajner_id')
                ->filter()->values()->all()
        )->orderBy('emri')->get();

        $lojtaret = Lojtar::whereNotIn(
            'id',
            $perdoruesit->pluck('lojtar_id')
                ->filter()->values()->all()
        )->orderBy('emri')->get();

        $menaxheret = Manager::whereNotIn(
            'id',
            $perdoruesit->pluck('manager_id')
                ->filter()->values()->all()
        )->orderBy('emri')->get();

        $roles = [
            'admin' => 'Administrator',
            'manager' => 'Menaxher',
            'coach' => 'Trajner',
            'player' => 'Volejbolliste',
            'pending' => 'Ne pritje'
        ];

        return compact(
            'user',
            'trajneret',
            'lojtaret',
            'menaxheret',
            'roles'
        );
    }

    private function validimi(
        Request $request,
        ?User $user = null
    ): array
    {
        $userId = $user?->id;

        $emailRule = Rule::unique('users', 'email');

        $trajnerRule = Rule::unique(
            'users',
            'trajner_id'
        );

        $lojtarRule = Rule::unique(
            'users',
            'lojtar_id'
        );

        $managerRule = Rule::unique(
            'users',
            'manager_id'
        );

        if ($userId) {
            $emailRule->ignore($userId);
            $trajnerRule->ignore($userId);
            $lojtarRule->ignore($userId);
            $managerRule->ignore($userId);
        }

        return $request->validate([

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                $emailRule
            ],

            'password' => [
                $user ? 'nullable' : 'required',
                'string',
                'confirmed',
                Password::min(8)
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

            'trajner_id' => [
                'exclude_unless:role,coach',
                'required',
                'integer',
                Rule::exists(
                    (new Trajner())->getTable(),
                    'id'
                ),
                $trajnerRule
            ],

            'lojtar_id' => [
                'exclude_unless:role,player',
                'required',
                'integer',
                Rule::exists(
                    (new Lojtar())->getTable(),
                    'id'
                ),
                $lojtarRule
            ],

            'manager_id' => [
                'exclude_unless:role,manager',
                'required',
                'integer',
                Rule::exists(
                    (new Manager())->getTable(),
                    'id'
                ),
                $managerRule
            ],

        ], [
            'trajner_id.required' =>
                'Zgjedh profilin e trajnerit.',

            'trajner_id.unique' =>
                'Ky trajner ka nje llogari ekzistuese.',

            'lojtar_id.required' =>
                'Zgjedh profilin e volejbollistes.',

            'lojtar_id.unique' =>
                'Kjo volejbolliste ka nje llogari ekzistuese.',

            'manager_id.required' =>
                'Zgjedh profilin e menaxherit.',

            'manager_id.unique' =>
                'Ky menaxher ka nje llogari ekzistuese.',

            'email.unique' =>
                'Ky email eshte ne perdorim.',

            'password.confirmed' =>
                'Fjalekalimet nuk perputhen.'
        ]);
    }

    private function lidheProfilin(
        User $user,
        array $validated
    ): void
    {
        // Largo lidhjet qe nuk i takojne rolit aktual

        $user->trajner_id = null;
        $user->lojtar_id = null;
        $user->manager_id = null;

        switch ($validated['role']) {

            case 'coach':
                $user->trajner_id =
                    $validated['trajner_id'];
                break;

            case 'player':
                $user->lojtar_id =
                    $validated['lojtar_id'];
                break;

            case 'manager':
                $user->manager_id =
                    $validated['manager_id'];
                break;
        }
    }
}
