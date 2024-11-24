<?php

namespace App\Providers;

use App\Contracts\Repositories\RegionRepository as RegionRepositoryContract;
use App\Contracts\Services\RegionService as RegionServiceContract;
use App\Repositories\Databases\RegionRepository as RegionDatabaseRepository;
use App\Repositories\Eloquents\RegionRepository as RegionEloquentRepository;
use App\Services\RegionService;
use Illuminate\Support\ServiceProvider;

class RegionServiceProvider extends ServiceProvider
{
    /**
     * database or eloquent
     */
    protected const REPOSTORY_FROM = 'database';

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(RegionServiceContract::class, RegionService::class);
        $this->app->bind(RegionRepositoryContract::class, function () {
            if (self::REPOSTORY_FROM === 'database') {
                return new RegionDatabaseRepository();
            }
            return new RegionEloquentRepository();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
