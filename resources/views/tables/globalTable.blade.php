@extends('admin.index')
@section('content')
<table class="w-full border-collapse border border-gray-300">
  <thead>
      <tr class="bg-gray-200" >
          <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">Nº</th>
          <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">Jugador</th>
          <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">1</th>
          <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">2</th>
          <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">3</th>
          <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">T1</th>
          <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">1</th>
          <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">2</th>
          <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">3</th>
          <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">T2</th>
          <th class="border border-[var(--azul)] p-2 text-lg font-bold text-white bg-[#BE1622]">Total</th>
      </tr>
  </thead>
  <tbody>
      <tr>
          <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">1</td>
          <td class="bg-green-300 border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">Jugador 1</td>
          <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">3</td>
          <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">2</td>
          <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">3</td>
          <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">8</td>
          <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">1</td>
          <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">2</td>
          <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">3</td>
          <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">6</td>
          <td class="border border-[var(--azul)] p-2 text-lg text-white text-center bg-[#BE1622]">14</td>
      </tr>
      <tr>
        <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">1</td>
        <td class="bg-yellow-200 border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">Jugador 1</td>
        <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">3</td>
        <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">2</td>
        <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">3</td>
        <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">8</td>
        <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">1</td>
        <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">2</td>
        <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">3</td>
        <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">6</td>
        <td class="border border-[var(--azul)] p-2 text-lg text-white text-center bg-[#BE1622]">14</td>
    </tr>
    <tr>
      <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">1</td>
      <td class="bg-red-400 border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">Jugador 1</td>
      <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">3</td>
      <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">2</td>
      <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">3</td>
      <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">8</td>
      <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">1</td>
      <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">2</td>
      <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">3</td>
      <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">6</td>
      <td class="border border-[var(--azul)] p-2 text-lg text-white text-center bg-[#BE1622]">14</td>
  </tr>
  <tr>
    <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">1</td>
    <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">Jugador 1</td>
    <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">3</td>
    <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">2</td>
    <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">3</td>
    <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">8</td>
    <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">1</td>
    <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">2</td>
    <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">3</td>
    <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">6</td>
    <td class="border border-[var(--azul)] p-2 text-lg text-white text-center bg-[#BE1622]">14</td>
  </tr>
  </tbody>
</table>
<div class="flex flex-row justify-center mt-4">
  <p class="bg-green-300 p-1 m-2 border rounded-md">Proximo a jugar</p>
  <p class="bg-yellow-200 p-1 m-2 border rounded-md">Se prepara</p>
  <p class="bg-red-400 p-1 m-2 border rounded-md">Recoge</p>
</div>
@endsection