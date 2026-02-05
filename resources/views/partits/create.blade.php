@extends('layouts.equip')
@section('title', __('Afegir nou partit'))

@section('content')
<h1 class="text-2xl font-bold mb-4">{{__('Afegir nou partit')}}</h1>

<form action="{{ route('partits.store') }}" method="POST" class="space-y-4">
  @csrf

    <div>
    <label for="estadi_id" class="block font-bold">{{__('Estadi')}}:</label>
    <select name="estadi_id" id="estadi_id" class="border p-2 w-full bg-red-800">
      @foreach ($estadis as $estadi)
        <option value="{{ $estadi->id }}" {{ old('estadi_id') == $estadi->id ? 'selected' : '' }}>
          {{ $estadi->nom }}
        </option>
      @endforeach
    </select>
  </div>

  <div>
    <label class="block font-bold ">{{__('Equip local')}}:</label>
    <select name="equip_local_id" class="border p-2 w-full bg-red-800">
      @foreach ($equips as $equip)
        <option value="{{ $equip->id }}">{{ $equip->nom }}</option>
      @endforeach
    </select>
  </div>

  <div>
    <label class="block font-bold">{{__('Equip visitant')}}:</label>
    <select name="equip_visitant_id" class="border p-2 w-full bg-red-800">
      @foreach ($equips as $equip)
        <option value="{{ $equip->id }}">{{ $equip->nom }}</option>
      @endforeach
    </select>
  </div>

  <div>
    <label class="block font-bold">{{__('Resultat')}}:</label>
    <input type="text" name="resultat" class="border p-2 w-full bg-red-800" placeholder="2 - 1">
  </div>

  <button class="bg-blue-600 text-white px-4 py-2 rounded">
    {{__('Afegir')}}
  </button>
</form>
@endsection
