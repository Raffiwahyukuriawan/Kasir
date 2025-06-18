<?php

namespace App\Providers;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->group(function () {
                require base_path('routes/web.php');
                require base_path('routes/admin.php'); // Tambahkan ini
            });
    }
}
