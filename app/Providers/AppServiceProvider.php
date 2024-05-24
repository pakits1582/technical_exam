<?php

namespace App\Providers;

use App\Services\ModelEventService;
use Illuminate\Support\ServiceProvider;
use App\Models\Factory;
use App\Models\Employee;

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
        $modelEventService = new ModelEventService();

        Factory::created(function ($model) use ($modelEventService) {
            $modelEventService->handleCreated($model);
        });

        Factory::updated(function ($model) use ($modelEventService) {
            $modelEventService->handleUpdated($model);
        });

        Factory::deleted(function ($model) use ($modelEventService) {
            $modelEventService->handleDeleted($model);
        });

        Employee::created(function ($model) use ($modelEventService) {
            $modelEventService->handleCreated($model);
        });

        Employee::updated(function ($model) use ($modelEventService) {
            $modelEventService->handleUpdated($model);
        });

        Employee::deleted(function ($model) use ($modelEventService) {
            $modelEventService->handleDeleted($model);
        });
    }
}
