@extends('layouts.equip')
@section('title', __('Editar jugadora'))

@section('content')
<form action="{{ route('jugadores.update', $jugadora) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label class="block text-sm font-medium">{{ __('Nom') }}</label>
        <input type="text" name="nom" value="{{ old('nom', $jugadora->nom) }}"
               class="w-full border rounded p-2 text-black">
        @error('nom') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">{{ __('Posició') }}</label>
        <input type="text" name="posicio" value="{{ old('posicio', $jugadora->posicio) }}"
               class="w-full border rounded p-2 text-black">
        @error('posicio') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">{{ __('Equip') }}</label>
        <select name="equip_id" class="w-full border rounded p-2 text-black">
            @foreach ($equips as $equip)
                <option value="{{ $equip->id }}"
                    @selected(old('equip_id', $jugadora->equip_id) == $equip->id)>
                    {{ $equip->nom }}
                </option>
            @endforeach
        </select>
        @error('equip_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <button class="px-4 py-2 bg-blue-600 text-white rounded">
        {{ __('Desar') }}
    </button>
</form>
@endsection
