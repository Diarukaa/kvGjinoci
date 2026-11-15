<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'filter' => [
                'nullable',
                Rule::in(['all', 'unread', 'read'])
            ],
        ]);

        $filter = $validated['filter'] ?? 'all';

        $query = $user->notifications();

        if ($filter === 'unread') {
            $query->whereNull('read_at');
        }

        if ($filter === 'read') {
            $query->whereNotNull('read_at');
        }

        $njoftimet = $query
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $totalNjoftime = $user
            ->notifications()
            ->count();

        $totalPalexuara = $user
            ->unreadNotifications()
            ->count();

        $totalLexuara = $totalNjoftime
            - $totalPalexuara;

        return view('njoftimet.index', compact(
            'njoftimet',
            'totalNjoftime',
            'totalPalexuara',
            'totalLexuara',
            'filter'
        ));
    }

    public function lexo(
        Request $request,
        string $id
    ) {

        // Vetem njoftimet e perdoruesit aktual

        $njoftimi = $request->user()
            ->notifications()
            ->findOrFail($id);

        $njoftimi->markAsRead();

        return back()->with(
            'success',
            'Njoftimi u shenua si i lexuar.'
        );
    }

    public function lexoKrejt(Request $request)
    {
        $request->user()
            ->unreadNotifications()
            ->update([
                'read_at' => now()
            ]);

        return back()->with(
            'success',
            'Te gjitha njoftimet u shenuan si te lexuara.'
        );
    }

    public function hap(
        Request $request,
        string $id
    ) {

        $njoftimi = $request->user()
            ->notifications()
            ->findOrFail($id);

        $njoftimi->markAsRead();

        $url = $njoftimi->data['url'] ?? '/dashboard';

        // Lejohen vetem faqet e brendshme te sistemit

        $allowedUrls = [
            '/dashboard',
            '/player/dashboard',
            '/coach/dashboard',
            '/manager/dashboard',
            '/financat-e-mia',
        ];

        if (!in_array($url, $allowedUrls, true)) {
            $url = '/dashboard';
        }

        return redirect($url);
    }

    public function destroy(
        Request $request,
        string $id
    ) {

        $njoftimi = $request->user()
            ->notifications()
            ->findOrFail($id);

        $njoftimi->delete();

        return back()->with(
            'success',
            'Njoftimi u fshi me sukses.'
        );
    }
}
