<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Bitlles Catalanes</title>
        <link rel="icon" href="{{ asset('main-img/icono.png') }}" type="image/x-icon">
        @vite(['resources/css/app.css', 'resources/css/admin.css'])
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
<body class="flex flex-col min-h-screen">

    @include('layouts.nav')

    @yield('content')

    @include('layouts.footer')

</body>
</html>
