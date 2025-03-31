<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__('main.login')}}</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <main class="flex-1 ms-10 me-10">
        <div class="text-center mt-10 mb-10">
            <h2 class="text-2xl font-bold text-[var(--azul)] mb-4">{{__('main.login')}}</h2>
        </div>

        <form action="#" method="POST" class="max-w-xl mx-auto">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-lg font-medium text-[var(--azul)]">{{__('main.email')}}</label>
                <input type="email" id="email" name="email" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" required placeholder="{{__('main.email_example')}}">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-lg font-medium text-[var(--azul)]">{{__('main.password')}}</label>
                <input type="password" id="password" name="password" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" required placeholder="********">
            </div>

            <div class="text-center mt-10">
                <button type="submit" class="bg-[var(--rojo)] text-[var(--blanco)] px-4 py-2 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105">
                    {{__('main.login')}}
                </button>
                <div class="mt-2">
                    <a href="#" class="text-[var(--azul)] hover:text-[var(--rojo)] font-semibold flex items-center justify-center transition duration-300 underline">
                        {{__('main.forgot_password')}}
                    </a>
                </div>
                <div class="mt-2">
                    <a href="#" class="text-[var(--azul)] hover:text-[var(--rojo)] font-semibold flex items-center justify-center transition duration-300 underline">
                        {{__('main.no_account')}}
                    </a>
                </div>                       
            </div>
        </form>
    </main>
</body>
</html>
