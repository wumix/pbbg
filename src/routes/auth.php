<?php
$router = $router;


// Authentication Routes...
$router->get('/', 'Medusa\App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
$router->get('/login', 'Medusa\App\Http\Controllers\Auth\LoginController@showLoginForm');
$router->post('login', 'Medusa\App\Http\Controllers\Auth\LoginController@login');
$router->post('logout', 'Medusa\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

// Registration Routes...
$router->get('register', 'Medusa\App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
$router->post('register', 'Medusa\App\Http\Controllers\Auth\RegisterController@register');

// Password Reset Routes...
$router->get('password/reset', 'Medusa\App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm');
$router->post('password/email', 'Medusa\App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail');
$router->get('password/reset/{token}', 'Medusa\App\Http\Controllers\Auth\ResetPasswordController@showResetForm');
$router->post('password/reset', 'Medusa\App\Http\Controllers\Auth\ResetPasswordController@reset');