@extends('admin.index')

@section('content')
<main class="flex-1 ms-10 me-10">
    <div class="text-center mt-10 mb-10">
        <h2 class="text-2xl font-bold text-[var(--azul)] mb-4">@lang('admin.player_registration')</h2>

        {{-- Mostrar mensaje de éxito --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <form action="{{route('create-player.store')}}" method="POST" enctype="multipart/form-data" class="max-w-xl mx-auto">
        @csrf

        <div class="mb-4">
            <label for="first_name" class="block text-lg font-medium text-[var(--azul)]">@lang('admin.first_name')</label>
            <input type="text" id="first_name" name="first_name" class="mt-2 p-2 w-full border @error('first_name') border-red-500 @else border-[var(--azul)] @enderror rounded bg-[var(--crema)]" required placeholder="@lang('admin.first_name_placeholder')" value="{{ old('first_name') }}">
            @error('first_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="last_name" class="block text-lg font-medium text-[var(--azul)]">@lang('admin.last_name')</label>
            <input type="text" id="last_name" name="last_name" class="mt-2 p-2 w-full border @error('last_name') border-red-500 @else border-[var(--azul)] @enderror rounded bg-[var(--crema)]" required placeholder="@lang('admin.last_name_placeholder')" value="{{ old('last_name') }}">
            @error('last_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-lg font-medium text-[var(--azul)]">@lang('admin.email')</label>
            <input type="email" id="email" name="email" class="mt-2 p-2 w-full border @error('email') border-red-500 @else border-[var(--azul)] @enderror rounded bg-[var(--crema)]" placeholder="@lang('admin.email_placeholder')" value="{{ old('email') }}">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="partner" class="block text-lg font-medium text-[var(--azul)]">@lang('admin.is_partner')</label>
            <select id="partner" name="partner" class="mt-2 p-2 w-full border @error('partner') border-red-500 @else border-[var(--azul)] @enderror rounded bg-[var(--crema)]" required>
                <option value="1" {{ old('partner') == 1 ? 'selected' : '' }}>@lang('admin.yes')</option>
                <option value="0" {{ old('partner') == 0 ? 'selected' : '' }}>@lang('admin.no')</option>
            </select>
            @error('partner')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="image" class="block text-lg font-medium text-[var(--azul)]">@lang('admin.profile_image')</label>
            <input type="file" id="image" name="image" class="mt-2 p-2 w-full border @error('image') border-red-500 @else border-[var(--azul)] @enderror rounded bg-[var(--crema)]" accept="image/*">
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="text-center mt-10">
            <button type="submit" class="bg-[var(--rojo)] text-[var(--blanco)] px-4 py-2 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105">
                @lang('admin.register_player')
            </button>
            <div class="mt-2">
                <a href="/admin" class="text-[var(--azul)] hover:text-[var(--rojo)] font-semibold flex items-center justify-center transition duration-300 underline">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                    </svg>
                    <span class="ms-1">@lang('admin.back_to_dashboard')</span>
                </a>
            </div>
        </div>
    </form>
</main>
@endsection