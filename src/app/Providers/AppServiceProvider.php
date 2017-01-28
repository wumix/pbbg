<?php

namespace Medusa\App\Providers;

use DebugBar\DataCollector\MessagesCollector;
use Illuminate\Support\ServiceProvider;
use Medusa\App\Characters;
use Medusa\App\Modules;
use View;
use Medusa\HookContainer;
use Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Debugbar collection
        app('debugbar')->addCollector(new MessagesCollector('hooks'));

        // Include the core service providers
        $this->app->register('Medusa\App\Providers\RouteServiceProvider');
        $this->app->register('Medusa\App\Providers\AdminServiceProvider');
        $this->app->register('Medusa\App\Providers\ViewServiceProvider');

        // Entrust for permissions & groups
        $this->app->register(\Zizaco\Entrust\EntrustServiceProvider::class);
        $this->app->alias('Entrust', \Zizaco\Entrust\EntrustFacade::class);

        if($this->app->isInstalled()) {
            $this->app->singleton('HookContainer', function () {
                return new HookContainer();
            });

            $this->app->singleton('character', function () {
                return Characters::find(cid());
            });

            $modules = Modules::all();

            $this->app->singleton('modules', function () use ($modules) {
                return $modules;
            });

            foreach ($modules as $module) {
                $provider = "\\Medusa\\Modules\\{$module->directory}\\Providers\\ModuleProvider";
                $this->app->register($provider);
            }
        }
        else
            abort(404, 'Application not installed');
        // Get all module service providers
//        $services = \File::directories(base_path('medusa/modules'));
        // Register all the module providers
//        foreach($services as $service)
//        {
//            $ex = explode('\\', $service);
//            $explode = end($ex);
//            $provider = "\\Medusa\\Modules\\{$explode}\\Providers\\ModuleProvider";
//            dd($provider);
//            $this->app->register($provider);
//        }

        // Add character stuff to the views
        
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
