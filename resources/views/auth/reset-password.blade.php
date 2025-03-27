<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Token oculto -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Campo de email -->
        <div>
            <x-input-label for="mail" :value="__('Correo Electrónico')" />
            <x-text-input id="mail" class="block mt-1 w-full" type="email" name="mail" :value="old('mail', $request->mail)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('mail')" class="mt-2" />
        </div>

        <!-- Campo de contraseña -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmación de contraseña -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Restablecer Contraseña') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
