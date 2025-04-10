@extends('admin.index')

@section('content')
    <main class="flex-1 ms-10 me-10">
        <div class="flex flex-col justify-center pt-16">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-[var(--azul)] mb-4">Identifica-te</h2>
            </div>
            <div class="flex justify-center p-4">
                <form action="" method="POST"  class="w-full max-w-lg">
                    <div>
                        <label for="code" class="block text-lg font-semibold text-[var(--azul)]">Introduce tu codigo de verificación:</label>
                        <input type="text" name="code" id="code" value="" required
                               class="w-full bg-[#F6F4F2] border border-[var(--azul)] rounded-md focus:border-sky-500 p-2 @error('name') border-red-500 @enderror">
                        @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-center mt-4">
                        <button type="submit" class="btn-primary px-4 py-2 bg-[var(--rojo)] text-white rounded-md transition-all duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105">
                            Verificar
                        </button>
                    </div>
                </form>

            </div>
        </div>



    </main>
@endsection
