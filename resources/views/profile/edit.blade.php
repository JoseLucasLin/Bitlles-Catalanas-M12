@extends('admin.index')

@section('content')
<main class="flex-1 ms-10 me-10">
    <div class="text-center mt-10 mb-10">
        <h2 class="text-2xl font-bold text-[var(--azul)] mb-4">{{ __('admin.profile.title') }}</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <!-- Información de perfil -->
        <div class="bg-[var(--crema)] p-6 shadow-xl rounded-lg border-[var(--azul)] border">
            <h3 class="text-lg font-bold text-[var(--azul)] mb-4">{{ __('admin.profile.personal_info') }}</h3>
            <p class="text-sm text-gray-600 mb-6">{{ __("admin.profile.personal_info_description") }}</p>

            <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                @csrf
                @method('patch')

                <div class="mb-4">
                    <div class="mb-8">
                        <div class="mb-3">
                            <div class="relative w-32 h-32 rounded-full overflow-hidden border-4 border-[var(--crema)]">
                                <img id="profilePreview" src="{{ asset('user-img/'.Auth::user()->image) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-200">
                                    <label for="image" class="cursor-pointer p-2 bg-[var(--rojo)] text-white rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <input type="file" id="image" name="image" class="hidden" accept="image/*" onchange="previewImage()">
                        @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <label for="name" class="block text-lg font-medium text-[var(--azul)]">{{ __('admin.profile.name') }}</label>
                    <input type="text" id="name" name="name" spellcheck="false" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--blanco)]" value="{{ old('name', $user->username) }}" required autofocus>
                    @error('name')
                        <p class="text-[var(--rojo)] text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-lg font-medium text-[var(--azul)]">{{ __('admin.profile.email') }}</label>
                    <input type="email" id="email" name="email" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--blanco)]" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <p class="text-[var(--rojo)] text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="text-center mt-6 flex justify-center">
                    <button type="submit" class="flex bg-[var(--rojo)] text-[var(--blanco)] px-4 py-2 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 me-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                          </svg>
                        {{ __('admin.profile.save_changes') }}
                    </button>
                </div>
                <div class="mt-2">
                    @if (session('status') === 'profile-updated')
                        <p class="text-[var(--verde)] text-sm">
                            {{ __('admin.profile.update_success') }}
                        </p>
                    @endif
                </div>
            </form>
        </div>

        <!-- Actualizar contraseña -->
        <div class="mt-6 bg-[var(--crema)] p-6 shadow-xl rounded-lg border-[var(--azul)] border">
            <h3 class="text-lg font-bold text-[var(--azul)] mb-4">{{ __('admin.profile.update_password') }}</h3>
            <p class="text-sm text-gray-600 mb-6">{{ __('admin.profile.password_description') }}</p>

            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="mb-4">
                    <label for="current_password" class="block text-lg font-medium text-[var(--azul)]">{{ __('admin.profile.current_password') }}</label>
                    <input type="password" id="current_password" name="current_password" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--blanco)]" required>
                    @error('current_password', 'updatePassword')
                        <p class="text-[var(--rojo)] text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-lg font-medium text-[var(--azul)]">{{ __('admin.profile.new_password') }}</label>
                    <input type="password" id="password" name="password" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--blanco)]" required>
                    @error('password', 'updatePassword')
                        <p class="text-[var(--rojo)] text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-lg font-medium text-[var(--azul)]">{{ __('admin.profile.confirm_password') }}</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--blanco)]" required>
                    @error('password_confirmation', 'updatePassword')
                        <p class="text-[var(--rojo)] text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="text-center mt-6 flex justify-center">
                    <button type="submit" class="flex bg-[var(--rojo)] text-[var(--blanco)] px-4 py-2 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 me-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                          </svg>
                        {{ __('admin.profile.change_password') }}
                    </button>
                </div>
                <div class="mt-2">
                    @if (session('status') === 'password-updated')
                        <p class="text-[var(--verde)] text-sm">
                            {{ __('admin.profile.password_success') }}
                        </p>
                    @endif
                </div>
            </form>
        </div>

        <!-- Eliminar cuenta -->
        <div class="mt-6 bg-[var(--crema)] p-6 shadow-xl rounded-lg border-[var(--azul)] border mb-10">
            <h3 class="text-lg font-bold text-[var(--azul)] mb-4">{{ __('admin.profile.delete_account') }}</h3>
            <p class="text-sm text-gray-600 mb-6">{{ __('admin.profile.delete_description') }}</p>

            <div class="text-center mt-6 flex justify-center">
                <button type="button" class="flex bg-[var(--rojo)] text-white px-4 py-2 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105" onclick="document.getElementById('confirm-delete-modal').classList.remove('hidden')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 me-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                      </svg>
                    {{ __('admin.profile.delete_button') }}
                </button>
            </div>

            <!-- Modal de confirmación de eliminación -->
            <div id="confirm-delete-modal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                    <h4 class="text-lg font-bold text-[var(--azul)] mb-4">{{ __('admin.profile.delete_confirm_title') }}</h4>
                    <p class="text-[var(--azul)] mb-4">{{ __('admin.profile.delete_confirm_message') }}</p>

                    <form method="post" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')

                        <div class="mb-4">
                            <input type="password" id="delete_password" name="password" class="mt-2 p-2 w-full border border-[var(--azul)] rounded" placeholder="{{ __('admin.profile.current_password') }}" required>
                            @error('password', 'userDeletion')
                                <p class="text-[var(--rojo)] text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-center space-x-3 transition-all duration-300">
                            <button type="button" class="flex font-bold px-4 py-2 border border-[var(--azul)] rounded text-[var(--azul)] hover:bg-[var(--crema-oscuro)] transition duration-300" onclick="document.getElementById('confirm-delete-modal').classList.add('hidden')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 me-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                  </svg>
                                {{ __('admin.profile.cancel') }}
                            </button>
                            <button type="submit" class="flex font-bold bg-[var(--rojo)] text-white px-4 py-2 rounded hover:bg-[var(--azul)] transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 me-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                  </svg>
                                {{ __('admin.profile.delete_button') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    function previewImage() {
        const file = document.getElementById('image').files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profilePreview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
