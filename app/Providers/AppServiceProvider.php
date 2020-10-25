<?php

namespace App\Providers;

use App\Applicant;
use App\Observers\ApplicantObserver;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Services\Interfaces\ViberServiceInterface;
use App\Services\ViberService;
use App\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ViberServiceInterface::class,
            ViberService::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        User::observe(UserObserver::class);
        Applicant::observe(ApplicantObserver::class);
    }
}
