<?php

namespace App\Providers;

use App\Repositories\AccountInterface;
use App\Repositories\BankInterface;
use App\Repositories\Eloquent\AccountRepository;
use App\Repositories\Eloquent\BankRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\UserInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserInterface::class,UserRepository::class);
        $this->app->bind(AccountInterface::class,AccountRepository::class);
        $this->app->bind(BankInterface::class,BankRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
