<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //Panel de admin
    public function index(){
        return view('admin.admin-panel');
    }

    //gestion de los torneos
    public function manageTournament($id){

    }
}
