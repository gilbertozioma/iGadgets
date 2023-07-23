<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // This method is used to register any application-specific services.
        // It is empty in this case, as we don't have any services to register.
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // This method is used to bootstrap the application services.

        // Configure the paginator to use Bootstrap for pagination rendering.
        Paginator::useBootstrap();

        // Retrieve the first setting from the database (usually contains website settings).
        $websiteSetting = Setting::first();

        // Share the $websiteSetting variable with all views.
        // This means the variable will be available in all blade templates.
        View::share('appSetting', $websiteSetting);
    }
}
