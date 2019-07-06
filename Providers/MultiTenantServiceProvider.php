<?php

namespace Modules\MultiTenant\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\MultiTenant\Tenant\TenantManager;

class MultiTenantServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Route::middleware(['web', 'api']);
        $this->publishes([
            __DIR__ . '/../Models/Tenant.php' => app_path('Models/Tenant.php')
        ], 'tenantModel');
    }

    public function register()
    {
        $this->app->singleton('MultiTenant.MultiTenant', function ($app) {
            return new TenantManager();
        });
    }
}