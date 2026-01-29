@extends('layouts.equip')
@section('title', 'Detall del partit')

@section('content')
<h1 class="text-2xl font-bold mb-4">
  {{ $partit->equipLocal->nom }} vs {{ $partit->equipVisitant->nom }}
</h1>

<ul class="space-y-2">
  <li><strong>{{__("Resultat")}}:</strong> {{ $partit->resultat }}</li>
  <li><strong>{{__("Estadi")}}:</strong> {{ $partit->estadi->nom }}</li>
</ul>

<p class="mt-4">
  <a href="{{ route('partits.index') }}" class="text-blue-700 hover:underline">
    ← Tornar a la llista
  </a>
</p>
@endsection
