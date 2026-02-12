@extends('layouts.equip')

@section('title', __('Partits'))

@section('content')
<div class="container">
  <h1 class="title">{{ __("Partits") }}</h1>

  <p class="mb-4">
    <a href="{{ route('partits.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">
      {{ __("Nou partit") }}
    </a>
  </p>

  <div class="grid-cards">
    @foreach ($partits as $partit)
      <article class="card">
        <header class="card__header">
          <h2 class="card__title">
            {{ $partit->equipLocal->nom }}
            vs
            {{ $partit->equipVisitant->nom }}
          </h2>
          <span class="card__badge">ID: {{ $partit->id }}</span>
        </header>

        <div class="card__body">
          <p>
            <strong>{{ __("Resultat") }}:</strong>
            {{ $partit->resultat }}
          </p>

          <p>
            <strong>{{ __("Estadi") }}:</strong>
            {{ $partit->estadi->nom }}
          </p>
        </div>

        <footer class="card__footer">
          <a class="btn btn--ghost" href="{{ route('partits.show', $partit) }}">
            {{ __("Vore") }}
          </a>

          <a class="btn btn--primary" href="{{ route('partits.edit', $partit) }}">
            {{ __("Editar") }}
          </a>

          <form method="POST" action="{{ route('partits.destroy', $partit) }}" class="inline">
            @csrf
            @method('DELETE')
            <button class="btn btn--danger" type="submit">
              {{ __("Esborrar") }}
            </button>
          </form>
        </footer>
      </article>
    @endforeach
  </div>
</div>
@endsection
