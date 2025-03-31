<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bitlles Catalanes</title>
    @vite(['resources/css/app.css'])
    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</head>
<body>

    @include('layouts.nav')

    @include('layouts.main-img')

    @include('main.active-tournament')
    @include('main.history-tournament')

    @include('layouts.footer')

</body>

<script>
    //aqui lo del slider
    var swiper = new Swiper(".multiple-slide-carousel", {
        loop: true,
        slidesPerView: 4,
        spaceBetween: 20,
        navigation: {
            nextEl: "#slider-button-right",
            prevEl: "#slider-button-left",
        },
        breakpoints: {
            1920: {
                slidesPerView: 4,
                spaceBetween: 30
            },
            1028: {
                slidesPerView: 2,
                spaceBetween: 30
            },
            990: {
                slidesPerView: 1,
                spaceBetween: 0
            }
        }
    });
</script>

</body>
</html>