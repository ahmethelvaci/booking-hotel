<?php

namespace App\Providers;

use App\Contracts\Repositories\HotelRepository as HotelRepositoryContract;
use App\Contracts\Services\HotelService as HotelServiceContract;
use App\Repositories\Databases\HotelRepository as HotelDatabasesRepository;
use App\Repositories\Eloquents\HotelRepository as HotelEloquentRepository;
use App\Services\HotelService;
use Illuminate\Support\ServiceProvider;

class HotelServiceProvider extends ServiceProvider
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
        $this->app->bind(HotelServiceContract::class, HotelService::class);
        $this->app->bind(HotelRepositoryContract::class, function () {
            if (self::REPOSTORY_FROM === 'database') {
                return new HotelDatabaseRepository();
            }
            return new HotelEloquentRepository();
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
