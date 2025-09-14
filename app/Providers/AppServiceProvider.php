<?php

namespace App\Providers;

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
         Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Database\\Factories\\' . class_basename($modelName) . 'Factory'
        );
    }
}
