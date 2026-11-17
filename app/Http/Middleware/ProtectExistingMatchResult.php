<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ProtectExistingMatchResult
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        $ndeshja = $request->route('ndeshja');

        if (!$ndeshja || !is_object($ndeshja)) {
            abort(404);
        }

        $existingMatch = DB::table('match_center_matches')
            ->where('ndeshja_id', $ndeshja->id)
            ->exists();

        // Ndeshjet qe tashme menaxhohen nga
        // Match Center perdorin validimet e tyre.

        if ($existingMatch) {
            return $next($request);
        }

        $status = mb_strtolower(
            trim((string) ($ndeshja->statusi ?? ''))
        );

        $finishedStatuses = [
            'perfunduar',
            'e perfunduar',
            'përfunduar',
            'e përfunduar',
            'finished',
            'completed',
            'ended',
        ];

        $homeSets = is_numeric($ndeshja->setet_tona ?? null)
            ? (int) $ndeshja->setet_tona
            : null;

        $awaySets = is_numeric(
            $ndeshja->setet_kundershtarit ?? null
        )
            ? (int) $ndeshja->setet_kundershtarit
            : null;

        $alreadyFinished =
            in_array($status, $finishedStatuses, true)
            || $homeSets === 3
            || $awaySets === 3;

        if ($alreadyFinished) {
            return redirect()
                ->route('match-center.index')
                ->with(
                    'error',
                    'Kjo ndeshje eshte perfunduar me heret. Rezultati ekzistues eshte mbrojtur nga mbishkrimi.'
                );
        }

        return $next($request);
    }
}
