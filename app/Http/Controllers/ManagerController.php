<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ManagerController extends Controller
{
    // READ - Lista e menaxhereve
    public function index(Request $request)
    {
        $search = $request->input('search');

        $managers = Manager::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('emri', 'like', "%{$search}%")
                        ->orWhere('mbiemri', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderBy('emri')
            ->paginate(10)
            ->withQueryString();

        $totalManagers = Manager::count();

        return view('managers.index', compact(
            'managers',
            'search',
            'totalManagers'
        ));
    }

    // CREATE - Shfaq formularin
    public function create()
    {
        return view('managers.create');
    }

    // CREATE - Ruaj menaxherin
    public function store(Request $request)
    {
        $validated = $this->validimi($request);

        Manager::create($validated);

        return redirect()
            ->route('managers.index')
            ->with('success', 'Menaxheri u regjistrua!');
    }

    // READ - Profili i menaxherit
    public function show(Manager $manager)
    {
        return view('managers.show', compact('manager'));
    }

    // UPDATE - Shfaq formularin
    public function edit(Manager $manager)
    {
        return view('managers.edit', compact('manager'));
    }

    // UPDATE - Ruaj ndryshimet
    public function update(
        Request $request,
        Manager $manager
    ) {
        $validated = $this->validimi(
            $request,
            $manager
        );

        $manager->update($validated);

        return redirect()
            ->route('managers.index')
            ->with('success', 'Menaxheri u perditesua!');
    }

    // DELETE - Fshi menaxherin
    public function destroy(Manager $manager)
    {
        $manager->delete();

        return redirect()
            ->route('managers.index')
            ->with('success', 'Menaxheri u fshi!');
    }

    // Validimi i perbashket
    private function validimi(
        Request $request,
        ?Manager $manager = null
    ): array {
        return $request->validate([
            'emri' => 'required|string|max:255',

            'mbiemri' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('managers', 'email')
                    ->ignore($manager?->id),
            ],

            'dataELindjes' => [
                'required',
                'date',
                'before:today',
            ],

            'nrTelefonit' => [
                'required',
                'string',
                'regex:/^\+3834[0-9]{7}$/'
            ],

            'vendbanimi' => 'required|string|max:255',
        ]);
    }
}
