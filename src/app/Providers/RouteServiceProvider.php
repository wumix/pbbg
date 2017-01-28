<?php

namespace Medusa\App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Route;

class RouteServiceProvider extends ServiceProvider
{

    private $middleware = [
        'character'             =>  \Medusa\App\Http\Middleware\CharacterCheck::class,
        'role'                  => \Medusa\App\Http\Middleware\EntrustRole::class,
        'permission'            => \Medusa\App\Http\Middleware\EntrustPermission::class,
        'ability'               => \Medusa\App\Http\Middleware\EntrustAbility::class,
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        Route::group([
            'middleware' => 'web'
        ], function ($router) {

            $path = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'routes'. DIRECTORY_SEPARATOR .'core.php';

            require $path;
        });

        foreach($this->middleware as $name => $class)
        {
            $router->middleware($name, $class);
        }
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
