@extends('admin.index')

@section('content')
    <main class="flex-1 ms-10 me-10">
        <div class="flex flex-col justify-center pt-16">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-[var(--azul)] mb-4">@lang('admin.tournament_creator')</h2>
            </div>
            <div class="flex justify-center p-4">
                <form action="{{ route('submitTournament') }}" method="POST" enctype="multipart/form-data" class="w-full max-w-lg">
                    @csrf
                    <div class="grid grid-cols-2 gap-4 mt-3 mb-2">
                        <!-- Campo Nombre -->
                        <div>
                            <label for="name" class="block text-lg font-semibold text-[var(--azul)]">@lang('admin.tournament_name')</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                   class="w-full bg-[#F6F4F2] border border-[var(--azul)] rounded-md focus:border-sky-500 p-2 @error('name') border-red-500 @enderror">
                            @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Campo Tipo -->
                        <div>
                            <label for="type" class="block text-lg font-semibold text-[var(--azul)]">@lang('admin.tournament_type')</label>
                            <select name="type" id="type" required class="w-full bg-[#F6F4F2] border border-[var(--azul)] rounded-md focus:border-sky-500 p-2 @error('type') border-red-500 @enderror">
                                <option value="">@lang('admin.select_option')</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}" @selected(old('type') == $type->id)>
                                        {{ $type->type_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Campo Precio Normal -->
                        <div>
                            <label for="normal_price" class="block text-lg font-semibold text-[var(--azul)]">@lang('admin.normal_price')</label>
                            <input type="number" name="normal_price" id="normal_price" step="0.01" value="{{ old('normal_price') }}" required
                                   class="w-full bg-[#F6F4F2] border border-[var(--azul)] rounded-md focus:border-sky-500 p-2 @error('normal_price') border-red-500 @enderror">
                            @error('normal_price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Campo Precio Partner -->
                        <div>
                            <label for="partner_price" class="block text-lg font-semibold text-[var(--azul)]">@lang('admin.partner_price')</label>
                            <input type="number" name="partner_price" id="partner_price" step="0.01" value="{{ old('partner_price') }}" required
                                   class="w-full bg-[#F6F4F2] border border-[var(--azul)] rounded-md focus:border-sky-500 p-2 @error('partner_price') border-red-500 @enderror">
                            @error('partner_price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Campo Fecha Estimada -->
                        <div>
                            <label for="expected_date" class="block text-lg font-semibold text-[var(--azul)]">@lang('admin.expected_date')</label>
                            <input type="date" name="expected_date" id="expected_date" value="{{ old('expected_date') }}" required
                                   class="w-full bg-[#F6F4F2] border border-[var(--azul)] rounded-md focus:border-sky-500 p-2 @error('expected_date') border-red-500 @enderror">
                            @error('expected_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Campo Imagen -->
                        <div>
                            <label for="image" class="block text-lg font-semibold text-[var(--azul)]">@lang('admin.image')</label>
                            <input type="file" name="image" id="image" accept="image/jpeg, image/png" required
                                   class="w-full bg-[#F6F4F2] border border-[var(--azul)] rounded-md focus:border-sky-500 p-2 @error('image') border-red-500 @enderror">
                            @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!--pistas-->
                        <div id="fields-container" class="col-span-2">
                            <h3 class="text-lg font-semibold text-[var(--azul)] mb-2">@lang('admin.add_fields')</h3>

                            <div class="field-group mb-4">
                                <input type="text" name="fields[0][name]" placeholder="@lang('admin.field_name')"
                                    class="field-input w-full mb-2 bg-[#F6F4F2] border border-[var(--azul)] rounded-md p-2" required>

                                <select name="fields[0][referee]" class="referee-select w-full bg-[#F6F4F2] border border-[var(--azul)] rounded-md p-2" required>
                                    <option value="">@lang('admin.select_referee')</option>
                                    @foreach($referees as $ref)
                                        <option value="{{ $ref->id }}">{{ $ref->username }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="button" id="add-field" class="mt-2 px-3 py-1 bg-[var(--azul)] text-white rounded hover:bg-[var(--rojo)] transition">
                                @lang('admin.add_field_button')
                            </button>
                        </div>
                    </div>

                    <!-- Mensajes generales de éxito/error -->
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="flex justify-center mt-4">
                        <button type="submit" class="btn-primary px-4 py-2 bg-[var(--rojo)] text-white rounded-md transition-all duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105">
                            @lang('admin.create_button')
                        </button>
                    </div>

                    <script>
                        let fieldIndex = 1;

                        document.getElementById('add-field').addEventListener('click', () => {
                            const container = document.getElementById('fields-container');
                            const group = document.createElement('div');
                            group.classList.add('field-group', 'mb-4');

                            group.innerHTML = `
                                <input type="text" name="fields[${fieldIndex}][name]" placeholder="@lang('admin.field_name')"
                                       class="field-input w-full mb-2 bg-[#F6F4F2] border border-[var(--azul)] rounded-md p-2" required>

                                <select name="fields[${fieldIndex}][referee]" class="referee-select w-full bg-[#F6F4F2] border border-[var(--azul)] rounded-md p-2" required>
                                    <option value="">@lang('admin.select_referee')</option>
                                    @foreach($referees as $ref)
                                        <option value="{{ $ref->id }}">{{ $ref->username }}</option>
                                    @endforeach
                                </select>
                            `;
                            container.insertBefore(group, document.getElementById('add-field'));
                            fieldIndex++;
                        });
                    </script>

                </form>
            </div>
        </div>
    </main>
@endsection