<?php
$router = $router;

$router->group([
    'prefix'    =>  'in',
    'middleware' =>  'character'
], function($router)
{
    $router->get('/', function()
    {
        return 'Hello World';
    })
        ->name('home');

});