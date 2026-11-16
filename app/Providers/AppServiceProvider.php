<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Ndeshja;
use App\Models\Stervitja;
use App\Models\Kontrata;
use App\Models\Pagesa;
use App\Observers\ActivityLogObserver;

use App\Observers\NdeshjaObserver;
use App\Observers\StervitjaObserver;
use App\Observers\KontrataObserver;
use App\Observers\PagesaObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Ndeshja::observe(NdeshjaObserver::class);
        Stervitja::observe(StervitjaObserver::class);
        Kontrata::observe(KontrataObserver::class);
        Pagesa::observe(PagesaObserver::class);

        $activityModels = [

            \App\Models\User::class,

            \App\Models\Lojtar::class,

            \App\Models\Trajner::class,

            \App\Models\Manager::class,

            \App\Models\Ekipi::class,

            \App\Models\Ndeshja::class,

            \App\Models\Stervitja::class,

            \App\Models\Prezenca::class,

            \App\Models\StatistikaLojtarit::class,

            \App\Models\Kontrata::class,

            \App\Models\Pagesa::class,

            \App\Models\Transaksioni::class,

            \App\Models\Sezoni::class,

            \App\Models\Klubi::class,

            \App\Models\Kampionati::class,

        ];

        foreach ($activityModels as $model) {

            $model::observe(ActivityLogObserver::class);

        }
    }
}
