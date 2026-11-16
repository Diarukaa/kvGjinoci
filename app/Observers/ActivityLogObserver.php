<?php

namespace App\Observers;

use App\Services\ActivityLogService;
use Illuminate\Database\Eloquent\Model;

class ActivityLogObserver
{
    public function __construct(
        private ActivityLogService $activityLog
    ) {
    }

    public function created(Model $model): void
    {
        $this->activityLog->record(
            $model,
            'Krijuar'
        );
    }

    public function updated(Model $model): void
    {
        $this->activityLog->record(
            $model,
            'Perditesuar'
        );
    }

    public function deleted(Model $model): void
    {
        $this->activityLog->record(
            $model,
            'Fshire'
        );
    }
}
