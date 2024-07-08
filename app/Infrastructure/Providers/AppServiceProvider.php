<?php

namespace App\Infrastructure\Providers;

use App\Domain\UserWithdrawal\UserWithdrawalRepositoryInterface;
use App\Domain\Withdrawal\WithdrawalRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\Repository\EloquentUserWithdrawalRepository;
use App\Infrastructure\Persistence\Eloquent\Repository\EloquentWithdrawalRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(WithdrawalRepositoryInterface::class, EloquentWithdrawalRepository::class);
        $this->app->bind(UserWithdrawalRepositoryInterface::class, EloquentUserWithdrawalRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
