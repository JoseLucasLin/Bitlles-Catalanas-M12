<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlayerController extends Controller
{
    //Crea un nuevo jugador
    public function create(){
        return view('admin.create-player');
    }

    //Guarda el jugador
    public function store(){

    }

    //Mostra formulario para editar jugador
    public function edit($id){
        //Preguntar por esta view que no la encuetro
    }

    //Actualiza el jugador
    public function update($id){

    }

    //Elimina un jugador
    public function destroy($id){

    }
}
