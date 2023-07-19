<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\App;


class NavbarController extends Controller
{
    public function sistema(){
        return view('home.sistema');
    }
    public function contato(){
        return view('home.contato');
    }
    public function tutorialView(){
        return view('home.tutorial');
    }
    public function tutorialDownload(){

        $pdf = Pdf::loadView('home.guia')->setPaper('a4');
    

        return $pdf->stream();
    }
}
