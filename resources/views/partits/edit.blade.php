@extends('layouts.equip')
@section('title', __('Editar partit'))

@section('content')
<form action="{{ route('partits.update', $partit) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label class="block text-sm font-medium">{{ __('Equip local') }}</label>
        <select name="equip_local_id" class="w-full border rounded p-2 text-black">
            @foreach ($equips as $equip)
                <option value="{{ $equip->id }}"
                    @selected(old('equip_local_id', $partit->equip_local_id) == $equip->id)>
                    {{ $equip->nom }}
                </option>
            @endforeach
        </select>
        @error('equip_local_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">{{ __('Equip visitant') }}</label>
        <select name="equip_visitant_id" class="w-full border rounded p-2 text-black">
            @foreach ($equips as $equip)
                <option value="{{ $equip->id }}"
                    @selected(old('equip_visitant_id', $partit->equip_visitant_id) == $equip->id)>
                    {{ $equip->nom }}
                </option>
            @endforeach
        </select>
        @error('equip_visitant_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">{{ __('Resultat') }}</label>
        <input type="text" name="resultat" value="{{ old('resultat', $partit->resultat) }}"
               class="w-full border rounded p-2 text-black">
        @error('resultat') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">{{ __('Estadi') }}</label>
        <select name="estadi_id" class="w-full border rounded p-2 text-black">
            @foreach ($estadis as $estadi)
                <option value="{{ $estadi->id }}"
                    @selected(old('estadi_id', $partit->estadi_id) == $estadi->id)>
                    {{ $estadi->nom }}
                </option>
            @endforeach
        </select>
        @error('estadi_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <button class="px-4 py-2 bg-blue-600 text-white rounded">
        {{ __('Desar') }}
    </button>
</form>
@endsection
