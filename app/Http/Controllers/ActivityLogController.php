<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ActivityLogController extends Controller
{
    private function kontrolloAdminin(
        Request $request
    ): void {

        abort_unless(
            $request->user()->role === 'admin',
            403
        );
    }

    public function index(Request $request)
    {
        $this->kontrolloAdminin($request);

        $filters = $request->validate([

            'user_id' => [
                'nullable',
                'integer',
                'min:1',
            ],

            'moduli' => [
                'nullable',
                Rule::in(ActivityLog::MODULET),
            ],

            'veprimi' => [
                'nullable',
                Rule::in(ActivityLog::VEPRIMET),
            ],

            'nga' => [
                'nullable',
                'date_format:Y-m-d',
            ],

            'deri' => [
                'nullable',
                'date_format:Y-m-d',
                'after_or_equal:nga',
            ],

            'search' => [
                'nullable',
                'string',
                'max:150',
            ],

        ]);

        $query = ActivityLog::query();

        if (!empty($filters['user_id'])) {

            $query->where(
                'user_id',
                $filters['user_id']
            );

        }

        if (!empty($filters['moduli'])) {

            $query->where(
                'moduli',
                $filters['moduli']
            );

        }

        if (!empty($filters['veprimi'])) {

            $query->where(
                'veprimi',
                $filters['veprimi']
            );

        }

        if (!empty($filters['nga'])) {

            $query->whereDate(
                'created_at',
                '>=',
                $filters['nga']
            );

        }

        if (!empty($filters['deri'])) {

            $query->whereDate(
                'created_at',
                '<=',
                $filters['deri']
            );

        }

        if (!empty($filters['search'])) {

            $search = $filters['search'];

            $query->where(function ($q) use ($search) {

                $q->where(
                    'pershkrimi',
                    'like',
                    '%' . $search . '%'
                )->orWhere(
                    'user_name',
                    'like',
                    '%' . $search . '%'
                )->orWhere(
                    'model_id',
                    '=',
                    $search
                );

            });

        }

        // Lista me filtra dhe pagination

        $logs = $query
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        // Statistikat e pergjithshme

        $totalLogs = ActivityLog::count();

        $sot = ActivityLog::whereDate(
            'created_at',
            today()
        )->count();

        $krijuar = ActivityLog::where(
            'veprimi',
            'Krijuar'
        )->count();

        $perditesuar = ActivityLog::where(
            'veprimi',
            'Perditesuar'
        )->count();

        $fshire = ActivityLog::where(
            'veprimi',
            'Fshire'
        )->count();

        // Perfshin edhe perdoruesit e fshire

        $perdoruesit = ActivityLog::whereNotNull(
            'user_id'
        )
            ->selectRaw(
                'user_id, MAX(id) as latest_id'
            )
            ->groupBy('user_id')
            ->pluck('latest_id');

        $perdoruesit = ActivityLog::whereIn(
            'id',
            $perdoruesit
        )
            ->orderBy('user_name')
            ->get([
                'user_id',
                'user_name',
            ]);

        $modulet = ActivityLog::MODULET;

        $veprimet = ActivityLog::VEPRIMET;

        return view('activity.index', compact(

            'logs',

            'filters',

            'totalLogs',

            'sot',

            'krijuar',

            'perditesuar',

            'fshire',

            'perdoruesit',

            'modulet',

            'veprimet'

        ));
    }

    public function show(
        Request $request,
        ActivityLog $activityLog
    ) {
        $this->kontrolloAdminin($request);

        $vleratVjetra =
            $activityLog->vlerat_vjetra ?? [];

        $vleratReja =
            $activityLog->vlerat_reja ?? [];

        $fields = array_values(
            array_unique(
                array_merge(
                    array_keys($vleratVjetra),
                    array_keys($vleratReja)
                )
            )
        );

        return view('activity.show', compact(

            'activityLog',

            'vleratVjetra',

            'vleratReja',

            'fields'

        ));
    }
}
