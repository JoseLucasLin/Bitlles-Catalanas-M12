<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RefereeController extends Controller
{
    //Abre el formulario para crear arbitros
    public function create(){
        return view('admin.create-referee');
    }

    //Guarda el arbitro
    public function store(){

    }

    //Abre el formulario de edicion de arbitros
    public function edit($id){

    }

    //Actualiza los arbitros
    public function update($id){

    }

    //Borra arbitros
    public function destroy($id){

    }
}
