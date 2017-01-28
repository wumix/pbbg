<?php
$router = $router;

// Admin routes
$router->group([
    'prefix'    =>  'admin',
    'middleware'=>  ['character', 'permission:admin|character']
], function($router)
{

    $router->group([
        'namespace' =>  'Medusa\App\Http\Controllers\Admin'
    ], function($router)
    {
        $router->get('/', function()
        {
            return redirect()
                ->route('admin.dashboard.index');
        });


        $router->get('dashboard', 'DashboardController@index')
            ->name('admin.dashboard.index');

        $router->resource('settings', 'SettingsController', [
            'names' =>  [
                'index'     =>  'admin.settings.index',
                'create'    =>  'admin.settings.create',
                'store'     =>  'admin.settings.store',
                'show'      =>  'admin.settings.show',
                'edit'      =>  'admin.settings.edit',
                'update'    =>  'admin.settings.update',
                'destroy'   =>  'admin.settings.destroy'
            ]
        ]);
        
        $router->get('settings/{id}/delete', 'SettingsController@delete')
            ->name('admin.settings.delete');

        $router->get('modules', 'ModulesController@index')
            ->name('admin.modules.index');

        $router->post('modules/{name}/install', 'ModulesController@install')
            ->name('admin.modules.install');

        $router->get('modules/{id}/settings', 'ModulesController@settings')
            ->name('admin.modules.settings');

        $router->get('modules/{id}/disable', 'ModulesController@disable')
            ->name('admin.modules.disable');

        $router->get('modules/delete', 'SettingsController@delete');
        
        $router->get('hooks/', 'HooksController@index')
            ->name('admin.hooks.index');

        $router->post('hooks/{name}/install', 'HooksController@install')
            ->name('admin.hooks.install');

        $router->post('hooks/{id}/disable', 'HooksController@disable')
            ->name('admin.hooks.disable');

        $router->get('hooks/{id}/disable', 'HooksController@index');

        $router->post('hooks/remove', 'HooksController@remove')
            ->name('admin.hooks.remove');
        
        $router->get('hooks/{id}', 'HooksController@settings')
            ->name('admin.hooks.settings');
        
        $router->get('hooks/delete', 'SettingsController@delete');

    });

});