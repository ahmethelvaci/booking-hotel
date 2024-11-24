<?php

namespace App\Providers;

use App\Contracts\Repositories\HotelRepository as HotelRepositoryContract;
use App\Contracts\Services\HotelService as HotelServiceContract;
use App\Repositories\Databases\HotelRepository as HotelDatabasesRepository;
use App\Repositories\Eloquents\HotelRepository as HotelElequentRepository;
use App\Services\HotelService;
use Illuminate\Support\ServiceProvider;

class HotelServiceProvider extends ServiceProvider
{
    /**
     * database or elequent
     */
    protected const REPOSTORY_FROM = 'elequent';
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
            return new HotelElequentRepository();
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
