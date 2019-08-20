<?php

namespace App\Providers;

use App\AppModule;
use App\Http\Resources\SuccessJSONResponseResource;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
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
        //
        $this->app->bind('PermissionType', 'App\Http\Enums\PermissionType');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191); //https://laravel-news.com/laravel-5-4-key-too-long-error
    }
}
