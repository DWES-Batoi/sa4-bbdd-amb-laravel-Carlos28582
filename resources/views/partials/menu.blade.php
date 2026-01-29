<nav>
  <ul class="flex space-x-4">
    <li><a class="text-white hover:underline" href="/">{{__("Inici")}}</a></li>

    {{-- Opcional: activarem l'enllaç d'equips quan el service estiga creat --}}
     <li><a class="text-white hover:underline" href="{{ route('equips.index') }}">Guia d'Equips</a></li> 

    <li><a class="text-white hover:underline" href="{{ route('estadis.index') }}">Llistat d'Estadis</a></li>
    <li><a class="text-white hover:underline" href="{{ route('jugadores.index') }}">Llistat de jugadores</a></li>
    <li><a class="text-white hover:underline" href="{{ route('partits.index') }}">Llistat de partits</a></li>
  </ul>
</nav>
