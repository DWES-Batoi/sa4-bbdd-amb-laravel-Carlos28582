@extends('layouts.equip')

@section('title', __("Estadis"))

@section('content')
<div class="container">
  <h1 class="title">{{ __("Llistat d'estadis") }}</h1>

  <p class="mb-4">
    <a href="{{ route('estadis.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">
      {{ __("Nou estadi") }}
    </a>
  </p>

  <div class="grid-cards">
    @foreach ($estadis as $estadi)
      <article class="card">
        <header class="card__header">
          <h2 class="card__title">{{ $estadi->nom }}</h2>
          <span class="card__badge">ID: {{ $estadi->id }}</span>
        </header>

        <div class="card__body">
          <p><strong>{{ __("Ciutat") }}:</strong> {{ $estadi->ciutat ?? '—' }}</p>
          <p><strong>{{ __("Capacitat") }}:</strong> {{ $estadi->capacitat ?? '—' }}</p>
        </div>

        <footer class="card__footer">
          <a class="btn btn--ghost" href="{{ route('estadis.show', $estadi) }}">{{ __("Vore") }}</a>
          <a class="btn btn--primary" href="{{ route('estadis.edit', $estadi) }}">{{ __("Editar") }}</a>

          <form method="POST" action="{{ route('estadis.destroy', $estadi) }}" class="inline">
            @csrf
            @method('DELETE')
            <button class="btn btn--danger" type="submit">{{ __("Esborrar") }}</button>
          </form>
        </footer>
      </article>
    @endforeach
  </div>
</div>
@endsection
