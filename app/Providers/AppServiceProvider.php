<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator; 
use App\Http\Responses\RegisterViewResponse;
use Laravel\Fortify\Contracts\RegisterViewResponse as RegisterViewResponseContract;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Mengonfigurasi pagination untuk menggunakan Bootstrap 4
        Paginator::useBootstrapFour();
    }
}
