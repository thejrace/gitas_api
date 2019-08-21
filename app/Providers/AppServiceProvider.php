<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        //
        $this->app->bind('PermissionType', 'App\Http\Enums\PermissionType');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Schema::defaultStringLength(191); //https://laravel-news.com/laravel-5-4-key-too-long-error
    }
}
