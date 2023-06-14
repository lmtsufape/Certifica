<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavbarController extends Controller
{
    public function sistema(){
        return view('home.sistema');
    }
    public function contato(){
        return view('home.contato');
    }
}
