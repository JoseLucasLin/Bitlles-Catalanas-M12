@extends('admin.index')

@section('content')
<main class="flex-1 ms-10 me-10">
    <div class="text-center mt-10 mb-10">
        <h2 class="text-2xl font-bold text-[var(--azul)] mb-4">{{ __('Mi Perfil') }}</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <!-- Información de perfil -->
        <div class="bg-[var(--crema)] p-6 shadow-xl rounded-lg border-[var(--azul)] border">
            <h3 class="text-lg font-semibold text-[var(--azul)] mb-4">{{ __('Información Personal') }}</h3>
            <p class="text-sm text-gray-600 mb-6">{{ __("Actualice su información de perfil y dirección de correo electrónico.") }}</p>

            <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                @csrf
                @method('patch')

                <div class="mb-4">
                    <label for="name" class="block text-lg font-medium text-[var(--azul)]">{{ __('Nombre') }}</label>
                    <input type="text" id="name" name="name" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" value="{{ old('name', $user->username) }}" required autofocus>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-lg font-medium text-[var(--azul)]">{{ __('Correo Electrónico') }}</label>
                    <input type="email" id="email" name="email" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="text-center mt-6">
                    <button type="submit" class="bg-[var(--rojo)] text-[var(--blanco)] px-4 py-2 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105">
                        {{ __('Guardar Cambios') }}
                    </button>
                </div>
                <!-- Añadir esto después del botón "Guardar Cambios" -->
                <div class="mt-2">
                    @if (session('status') === 'profile-updated')
                        <p class="text-green-600 text-sm">
                            {{ __('¡Perfil actualizado correctamente!') }}
                        </p>
                    @endif
                </div>
            </form>
        </div>

        <!-- Actualizar contraseña -->
        <div class="mt-6 bg-[var(--crema)] p-6 shadow-xl rounded-lg border-[var(--azul)] border">
            <h3 class="text-lg font-semibold text-[var(--azul)] mb-4">{{ __('Actualizar Contraseña') }}</h3>
            <p class="text-sm text-gray-600 mb-6">{{ __('Asegúrese de que su cuenta esté usando una contraseña larga y aleatoria para mantener la seguridad.') }}</p>

            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="mb-4">
                    <label for="current_password" class="block text-lg font-medium text-[var(--azul)]">{{ __('Contraseña Actual') }}</label>
                    <input type="password" id="current_password" name="current_password" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" required>
                    @error('current_password', 'updatePassword')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-lg font-medium text-[var(--azul)]">{{ __('Nueva Contraseña') }}</label>
                    <input type="password" id="password" name="password" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" required>
                    @error('password', 'updatePassword')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-lg font-medium text-[var(--azul)]">{{ __('Confirmar Contraseña') }}</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" required>
                    @error('password_confirmation', 'updatePassword')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="text-center mt-6">
                    <button type="submit" class="bg-[var(--rojo)] text-[var(--blanco)] px-4 py-2 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105">
                        {{ __('Cambiar Contraseña') }}
                    </button>
                </div>
                <!-- Añadir esto después del botón "Cambiar Contraseña" -->
                <div class="mt-2">
                    @if (session('status') === 'password-updated')
                        <p class="text-green-600 text-sm">
                            {{ __('¡Contraseña actualizada correctamente!') }}
                        </p>
                    @endif
                </div>
            </form>
        </div>

        <!-- Eliminar cuenta -->
        <div class="mt-6 bg-[var(--crema)] p-6 shadow-xl rounded-lg border-[var(--azul)] border">
            <h3 class="text-lg font-semibold text-[var(--azul)] mb-4">{{ __('Eliminar Cuenta') }}</h3>
            <p class="text-sm text-gray-600 mb-6">{{ __('Una vez que se elimine su cuenta, todos sus recursos y datos se borrarán permanentemente. Antes de eliminar su cuenta, descargue cualquier dato o información que desee conservar.') }}</p>

            <div class="text-center mt-6">
                <button type="button" class="bg-red-600 text-white px-4 py-2 rounded transition duration-300 hover:bg-red-700 font-bold hover:scale-105" onclick="document.getElementById('confirm-delete-modal').classList.remove('hidden')">
                    {{ __('Eliminar Cuenta') }}
                </button>
            </div>

            <!-- Modal de confirmación de eliminación -->
            <div id="confirm-delete-modal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                    <h4 class="text-lg font-bold text-gray-900 mb-4">{{ __('¿Está seguro de que desea eliminar su cuenta?') }}</h4>
                    <p class="text-gray-600 mb-4">{{ __('Una vez que se elimine su cuenta, todos sus recursos y datos se borrarán permanentemente. Por favor, ingrese su contraseña para confirmar que desea eliminar permanentemente su cuenta.') }}</p>

                    <form method="post" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')

                        <div class="mb-4">
                            <input type="password" id="delete_password" name="password" class="mt-2 p-2 w-full border border-gray-300 rounded" placeholder="{{ __('Contraseña') }}" required>
                            @error('password', 'userDeletion')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button" class="px-4 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-100" onclick="document.getElementById('confirm-delete-modal').classList.add('hidden')">
                                {{ __('Cancelar') }}
                            </button>
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                {{ __('Eliminar Cuenta') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
