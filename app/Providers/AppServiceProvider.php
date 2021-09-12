<?php

namespace App\Providers;

use App\Models\Applicant;
use App\Models\Partner;
use App\Models\User;
use App\Observers\ApplicantObserver;
use App\Observers\PartnerObserver;
use App\Observers\UserObserver;
use App\Services\ApplicantService;
use App\Services\Interfaces\ApplicantServiceInterface;
use App\Services\Interfaces\ViberServiceInterface;
use App\Services\ViberService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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

        $this->app->bind(
            ApplicantServiceInterface::class,
            ApplicantService::class
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
        Partner::observe(PartnerObserver::class);
        URL::forceRootURL(config('app.url'));
        if (config('app.env') === 'production') {
            \URL::forceScheme('https');
        }
    }
}
