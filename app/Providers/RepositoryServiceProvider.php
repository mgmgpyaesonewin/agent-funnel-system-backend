<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->bind(
            'App\Interfaces\ContractInterface',
            'App\Repositories\ContractRepository'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
    }
}
