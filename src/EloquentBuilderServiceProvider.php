<?php

namespace Nhn\EloquentBuilder;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class EloquentBuilderServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        Str::macro('nhn', function ($value) {
            return 123;
        });
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/boilerplate.php', 'boilerplate');
    }
}
