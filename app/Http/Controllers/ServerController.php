<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServerController extends Controller
{
    public function index(){
        //dd("asd");
        return view('indexWS');
    }
}
