@extends('layouts.equip')
@section('title', __('Partits'))

@section('content')
<h1 class="text-3xl font-bold text-blue-800 mb-6">{{__("Partits")}}
</h1>
<p class="mb-4">
  <a href="{{ route('partits.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">
   {{__("Nou partit")}}
  </a>
</p>
<table class="w-full border-collapse border border-gray-300">
  <thead class="bg-gray-200">
    <tr>
      <th class="border p-2">{{__("Local")}}</th>
      <th class="border p-2">{{__("Visitant")}}</th>
      <th class="border p-2">{{__("Resultat")}}</th>
      <th class="border p-2">{{__("Estadi")}}</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($partits as $partit)
    <tr class="hover:bg-gray-100">
      <td class="border p-2">{{ $partit->equipLocal->nom }}</td>
      <td class="border p-2">{{ $partit->equipVisitant->nom }}</td>
      <td class="border p-2">
        <a href="{{ route('partits.show', $partit->id) }}" class="text-blue-700 hover:underline">
          {{ $partit->resultat }}
        </a>
      </td>
      <td class="border p-2">{{ $partit->estadi->nom }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
