<?php

namespace Medusa\App\Providers;

use Illuminate\Support\ServiceProvider;
use Medusa\App\Characters;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->commands([
            \Medusa\App\Console\Commands\CreateModule::class
        ]);
        
        
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
