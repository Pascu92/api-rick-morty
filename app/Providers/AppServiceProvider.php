<?php

namespace App\Providers;

use App\Services\CharacterService;
use App\Services\Filters\CharacterFilterService;
use App\Services\RickAndMortyService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(RickAndMortyService::class, function ($app) {
            return new RickAndMortyService();
        });
        $this->app->singleton(CharacterFilterService::class, function ($app) {
            return new CharacterFilterService();
        });

        $this->app->singleton(CharacterService::class, function ($app) {
            return new CharacterService(
                $app->make(CharacterFilterService::class),
                $app->make(RickAndMortyService::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
