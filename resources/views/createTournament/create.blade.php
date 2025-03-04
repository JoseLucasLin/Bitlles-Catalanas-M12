<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/css/createTournamet.css'])
  <title>Document</title>
</head>
<body class="bg-[#ffffff]">
  <div class="flex flex-col justify-center pt-16">
    <div class="text-center border border-blue-500">
      <h1 class="text-2xl">Creador de Torneos</h1>
    </div>
    <div class="flex justify-center border border-blue-500 p-4">
      <form action="" method="GET" class="w-full max-w-lg">
        <div class="grid grid-cols-2 gap-4 mt-3 mb-2">
          <div>
            <label for="name" class="block">Nombre Torneo</label>
            <input type="text" name="name" id="name" class="w-full bg-[#F6F4F2] border border-[#2F3B64] rounded-md focus:border-sky-500 p-2">
          </div>
          <div>
            <label for="type" class="block">Tipo de torneo</label>
            <select name="type" id="type" class="w-full bg-[#F6F4F2] border border-[#2F3B64] rounded-md focus:border-sky-500 p-2">
              <option value="1">opcion1</option>
              <option value="2">opcion2</option>
              <option value="3">opcion3</option>
            </select>
          </div>
          <div>
            <label for="price" class="block">Precio</label>
            <input type="number" name="price" id="price" step="0.01" class="w-full bg-[#F6F4F2] border border-[#2F3B64] rounded-md focus:border-sky-500 p-2">
          </div>
          <div>
            <label for="partnerPrice" class="block">Precio partner</label>
            <input type="number" name="partnerPrice" id="partnerPrice" step="0.01" class="w-full bg-[#F6F4F2] border border-[#2F3B64] rounded-md focus:border-sky-500 p-2">
          </div>
          <div>
            <label for="date" class="block">Fecha</label>
            <input type="date" name="date" id="date" class="w-full bg-[#F6F4F2] border border-[#2F3B64] rounded-md focus:border-sky-500 p-2">
          </div>
          <div>
            <label for="image" class="block">Imagen</label>
            <input type="file" name="image" id="image" class="w-full bg-[#F6F4F2] border border-[#2F3B64] rounded-md focus:border-sky-500 p-2">
          </div>
        </div>
        <div class="flex justify-center mt-4">
          <button class="btn-primary px-4 py-2 bg-[#2F3B64] text-white rounded-md">Crear</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
