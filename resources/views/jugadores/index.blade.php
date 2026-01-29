@extends('layouts.equip')
@section('title', __('Llista de jugadores'))

@section('content')
<h1 class="text-3xl font-bold text-blue-800 mb-6">{{__("Jugadores")}}</h1>

@if (session('success'))
  <div class="bg-green-100 text-green-700 p-2 mb-4">{{ session('success') }}</div>
@endif

<p class="mb-4">
  <a href="{{ route('jugadores.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">
   {{__("Nova jugadora")}}
  </a>
</p>

<table class="w-full border-collapse border border-gray-300">
  <thead class="bg-gray-200">
    <tr>
      <th class="border p-2">{{__("Nom")}}</th>
      <th class="border p-2">{{__("Edat")}}</th>
      <th class="border p-2">{{__("Posició")}}</th>
      <th class="border p-2">{{__("Equip")}}</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($jugadores as $jugadora)
    <tr class="hover:bg-gray-100">
      <td class="border p-2">
        <a href="{{ route('jugadores.show', $jugadora->id) }}" class="text-blue-700 hover:underline">
          {{ $jugadora->nom }}
        </a>
      </td>
      <td class="border p-2">{{ $jugadora->edat }}</td>
      <td class="border p-2">{{ $jugadora->posicio }}</td>
      <td class="border p-2">{{ $jugadora->equip->nom ?? '—' }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
