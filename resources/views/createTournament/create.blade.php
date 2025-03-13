<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/createTournamet.css'])
    <title>Document</title>
</head>
@extends('admin.index')
@section('content')
<body class="bg-[#ffffff]">
    <div class="flex flex-col justify-center pt-16">
        <div class="text-center">
            <h2 class="text-2xl font-bold text-[var(--azul)] mb-4">Creador de Torneos</h2>
        </div>
        <div class="flex justify-center p-4">
            <form action="" method="GET" class="w-full max-w-lg">
                <div class="grid grid-cols-2 gap-4 mt-3 mb-2">
                    <div>
                        <label for="name" class="block text-lg font-semibold text-[var(--azul)]">Nombre Torneo</label>
                        <input type="text" name="name" id="name" class="w-full bg-[#F6F4F2] border border-[var(--azul)] rounded-md focus:border-sky-500 p-2">
                    </div>
                    <div>
                        <label for="type" class="block text-lg font-semibold text-[var(--azul)]">Tipo de torneo</label>
                        <select name="type" id="type" class="w-full bg-[#F6F4F2] border border-[var(--azul)] rounded-md focus:border-sky-500 p-2">
                        <option value="1">opcion1</option>
                        <option value="2">opcion2</option>
                        <option value="3">opcion3</option>
                        </select>
                    </div>
                    <div>
                        <label for="price" class="block text-lg font-semibold text-[var(--azul)]">Precio</label>
                        <input type="number" name="price" id="price" step="0.01" class="w-full bg-[#F6F4F2] border border-[var(--azul)] rounded-md focus:border-sky-500 p-2">
                    </div>
                    <div>
                        <label for="partnerPrice" class="block text-lg font-semibold text-[var(--azul)]">Precio partner</label>
                        <input type="number" name="partnerPrice" id="partnerPrice" step="0.01" class="w-full bg-[#F6F4F2] border border-[var(--azul)] rounded-md focus:border-sky-500 p-2">
                    </div>
                    <div>
                        <label for="date" class="block text-lg font-semibold text-[var(--azul)]">Fecha</label>
                        <input type="date" name="date" id="date" class="w-full bg-[#F6F4F2] border border-[var(--azul)] rounded-md focus:border-sky-500 p-2">
                    </div>
                    <div>
                        <label for="image" class="block text-lg font-semibold text-[var(--azul)]">Imagen</label>
                        <input type="file" name="image" id="image" class="w-full bg-[#F6F4F2] border border-[var(--azul)] rounded-md focus:border-sky-500 p-2">
                    </div>
                    </div>
                        <div class="flex justify-center mt-4">
                        <button class="btn-primary px-4 py-2 bg-[#BE1622] text-white rounded-md">Crear</button>
                    </div>
            </form>
        </div>
    </div>
</body>


@endsection


