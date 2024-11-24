<?php

namespace App\Providers;

use App\Contracts\Repositories\ReservationRepository as ReservationRepositoryContract;
use App\Contracts\Services\ReservationService as ReservationServiceContract;
use App\Repositories\Databases\ReservationRepository as ReservationDatabaseRepository;
use App\Repositories\Eloquents\ReservationRepository as ReservationEloquentRepository;
use App\Services\ReservationService;
use Illuminate\Support\ServiceProvider;

class ReservationServiceProvider extends ServiceProvider
{
    /**
     * database or eloquent
     */
    protected const REPOSTORY_FROM = 'eloquent';

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ReservationServiceContract::class, ReservationService::class);
        $this->app->bind(ReservationRepositoryContract::class, function () {
            if (self::REPOSTORY_FROM === 'database') {
                return new ReservationDatabaseRepository();
            }
            return new ReservationEloquentRepository();
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
