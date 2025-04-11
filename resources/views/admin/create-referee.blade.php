@extends('admin.index')

@section('content')
<main class="flex-1 ms-10 me-10">
    <div class="text-center mt-10 mb-10">
        <h2 class="text-2xl font-bold text-[var(--azul)] mb-4">{{__('admin.ct_referee.register_of_referee')}}</h2>
    </div>
    <x-guest-layout>
    <form action="{{ route('registro.store') }}" method="POST" enctype="multipart/form-data" class="max-w-xl mx-auto">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <x-input-label for="username" :value="__('admin.ct_referee.register_referee')"  class="block text-lg font-medium text-[var(--azul)]"/>
            <x-text-input id="username"  type="text" name="username" :value="old('username')" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" required placeholder="{{__('admin.ct_referee.enter_username')}}" autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>
    
    
    
        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('admin.ct_referee.email')"  class="block text-lg font-medium text-[var(--azul)]"/>
            <x-text-input id="email" type="email" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]"  type="email" name="email" :value="old('email')" required placeholder="{{__('admin.ct_referee.example_email')}}" autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
    
    
        <!-- Password -->
        <div class="mb-4 relative">
            <x-input-label for="password" class="block text-lg font-medium text-[var(--azul)]" :value="__('admin.ct_referee.password')" />
    
            <x-text-input id="password" class="block mt-1 w-full" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)] pr-10"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="{{__('admin.ct_referee.create_password')}}" />
                            <span class="absolute inset-y-0 right-0 pr-3 flex items-center mt-8 cursor-pointer" onclick="togglePasswordVisibility('password', 'password-toggle')">
                                <svg id="password-toggle" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </span>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
    
    
        <!-- Confirm Password -->
        <div class="mb-4 relative">
            <x-input-label for="password_confirmation" class="block text-lg font-medium text-[var(--azul)]" :value="__('admin.ct_referee.confirm_password')" />
    
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)] pr-10" required placeholder="{{__('admin.ct_referee.repeat_password')}}" autocomplete="new-password" />
                <span class="absolute inset-y-0 right-0 pr-3 flex items-center mt-8 cursor-pointer" onclick="togglePasswordVisibility('password_confirmation', 'confirm-password-toggle')">
                    <svg id="confirm-password-toggle" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                       <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                   </svg>
                </span>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <div class="mb-4">
            <label for="image" class="block text-lg font-medium text-[var(--azul)]">{{__('admin.ct_referee.profile_image')}}</label>
            <input type="file" id="image" name="image" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" accept="image/*">
        </div>

        <div class="text-center mt-10">
            <button type="submit" class="bg-[var(--rojo)] text-[var(--blanco)] px-4 py-2 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105">
                {{__('admin.ct_referee.register_referee')}}
            </button>
            <div class="mt-2">
                <a href="/admin" class="text-[var(--azul)] hover:text-[var(--rojo)] font-semibold flex items-center justify-center transition duration-300 underline">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                    </svg>
                    <span class="ms-1">{{__('admin.ct_referee.back_to_dashboard')}}</span>
                </a>
            </div>                       
        </div>
    </form>
    </x-guest-layout>




    
</main>




<script>
    function togglePasswordVisibility(fieldId, toggleId) {
        const passwordField = document.getElementById(fieldId);
        const toggleIcon = document.getElementById(toggleId);

        if (passwordField.type === "password" || passwordField.type === "password_confirmation") {
            passwordField.type = "text";
            toggleIcon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>`;
        } else {
            passwordField.type = "password";
            toggleIcon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" /></svg>`;
        }
    }
</script>
@endsection