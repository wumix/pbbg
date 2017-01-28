<?php

namespace Medusa\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Medusa\App\User;
use Illuminate\Http\Request;
use Medusa\App\Characters;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', [
            'except'    =>  'index'
        ]);
    }

    
    public function welcome()
    {
        return view('home');
    }
}
