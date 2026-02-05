@extends('layouts.equip')

@section('title', __("Jugadores"))

@section('content')
<div class="container">
  <h1 class="title">{{ __("Llistat de jugadores") }}</h1>

  <p class="mb-4">
    <a href="{{ route('jugadores.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">
      {{ __("Nova jugadora") }}
    </a>
  </p>

  <div class="grid-cards">
    @foreach ($jugadores as $jugadora)
      <article class="card">
        <header class="card__header">
          <h2 class="card__title">{{ $jugadora->nom }}</h2>
          <span class="card__badge">ID: {{ $jugadora->id }}</span>
        </header>

        <div class="card__body">
          <p>
            <strong>{{ __("Equip") }}:</strong>
            {{ $jugadora->equip->nom ?? '—' }}
          </p>

          <p>
            <strong>{{ __("Posició") }}:</strong>
            {{ $jugadora->posicio ?? '—' }}
          </p>
        </div>

        <footer class="card__footer">
          <a class="btn btn--ghost" href="{{ route('jugadores.show', $jugadora) }}">
            {{ __("Vore") }}
          </a>

          <a class="btn btn--primary" href="{{ route('jugadores.edit', $jugadora) }}">
            {{ __("Editar") }}
          </a>

          <form method="POST" action="{{ route('jugadores.destroy', $jugadora) }}" class="inline">
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
