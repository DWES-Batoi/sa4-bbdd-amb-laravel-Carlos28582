@extends('layouts.equip')
@section('title', __('Editar estadi'))

@section('content')
<form action="{{ route('estadis.update', $estadi) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label class="block text-sm font-medium">{{ __('Nom') }}</label>
        <input type="text" name="nom" value="{{ old('nom', $estadi->nom) }}"
               class="w-full border rounded p-2 text-black">
        @error('nom') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">{{ __('Ciutat') }}</label>
        <input type="text" name="ciutat" value="{{ old('ciutat', $estadi->ciutat) }}"
               class="w-full border rounded p-2 text-black">
        @error('ciutat') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">{{ __('Capacitat') }}</label>
        <input type="number" name="capacitat" value="{{ old('capacitat', $estadi->capacitat) }}"
               class="w-full border rounded p-2 text-black">
        @error('capacitat') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <button class="px-4 py-2 bg-blue-600 text-white rounded">
        {{ __('Desar') }}
    </button>
</form>
@endsection
