<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bitlles Catalanes</title>
    @vite(['resources/css/app.css'])
</head>
<body>

    @include('layouts.nav')

    <h1 class="text-3xl font-bold underline">
        ¡Bienvenido a mi proyecto Laravel!
    </h1>
    @include('layouts.main-img')

    @include('main.active-tournament')
    @include('main.history-tournament')

    @include('layouts.footer')

</body>

<script>
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuButton.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
</script>

</html>