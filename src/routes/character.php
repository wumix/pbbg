<?php
$router = $router;

// Character routes
$router->group([
    'prefix'    =>  'characters',
    'middleware'=>  'auth'
], function($router)
{

    $router->get('/', 'Medusa\App\Http\Controllers\CharacterController@index')
        ->name('characters.index');
    
    $router->get('choose',  'Medusa\App\Http\Controllers\CharacterController@choose')
        ->name('characters.choose');

    $router->post('choose', 'Medusa\App\Http\Controllers\CharacterController@postChoose')
        ->name('characters.choose.post');

    $router->post('create', 'Medusa\App\Http\Controllers\CharacterController@postNew')
        ->name('characters.create');
});