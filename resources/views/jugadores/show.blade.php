@extends('layouts.equip')
@section('title', 'Detall de la jugadora')

@section('content')
<h1 class="text-2xl font-bold mb-4">{{ $jugadora->nom }}</h1>

<ul class="space-y-2">
  <li><strong>Edat:</strong> {{ $jugadora->edat }}</li>
  <li><strong>Posició:</strong> {{ $jugadora->posicio }}</li>
  <li><strong>Equip:</strong> {{ $jugadora->equip->nom ?? '—' }}</li>
</ul>

<p class="mt-4">
  <a href="{{ route('jugadores.index') }}" class="text-blue-700 hover:underline">
    ← Tornar a la llista
  </a>
</p>
@endsection
