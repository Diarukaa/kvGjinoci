<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Ndeshja;
use App\Models\Stervitja;
use App\Models\Kontrata;
use App\Models\Pagesa;

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
    }
}
