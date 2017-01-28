<?php

namespace {{namespace}};

use Illuminate\Support\ServiceProvider;

class {{class}} extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(base_path('medusa\\modules\\{{modulename}}\\views'), '{{lcmodulename}}');
        $this->loadRoutesFrom(base_path('medusa\\modules\\{{modulename}}\\routes.php'));
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
