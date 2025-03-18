<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TournamentController extends Controller
{
    //Abre el formulario de creacion de torneos
    public function create()
    {
        return view('admin.create-tournament');
    }

//    //Guarda el torneo
//    public function store(){
//
//    }
//
//    //Abre el formulario de edicion de torneos
//    public function edit($id){
//        return view('admin.tournament-manager');
//    }
//
//    //Actualiza el torneo
//    public function update($id){
//
//    }
//
//    //Elimina un torneo
//    public function destroy($id){
//
//    }
}
