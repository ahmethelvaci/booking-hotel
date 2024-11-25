<?php

namespace App\Providers;

use App\Contracts\Repositories\PaymentRepository as PaymentRepositoryContract;
use App\Contracts\Services\PaymentService as PaymentServiceContract;
use App\Repositories\Databases\PaymentRepository as PaymentDatabaseRepository;
use App\Repositories\Eloquents\PaymentRepository as PaymentEloquentRepository;
use App\Services\PaymentService;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
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
        $this->app->bind(PaymentServiceContract::class, PaymentService::class);
        $this->app->bind(PaymentRepositoryContract::class, function () {
            if (self::REPOSTORY_FROM === 'database') {
                return new PaymentDatabaseRepository();
            }
            return new PaymentEloquentRepository();
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
