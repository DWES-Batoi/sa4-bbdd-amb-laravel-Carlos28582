<?php

namespace App\Http\Controllers;

use App\Models\Jugadora;
use App\Models\Equip;
use Illuminate\Http\Request;

class JugadoraController extends Controller
{
    // GET /jugadores
    public function index()
    {
        $jugadores = Jugadora::all();
        return view('jugadores.index', compact('jugadores'));
    }

    // GET /jugadoras/{jugadora}
    public function show(Jugadora $jugadora)
    {
        return view('jugadores.show', compact('jugadora'));
    }

    // GET /jugadoras/create
    public function create()
    {
        $equips = Equip::all();
        return view('jugadores.create', compact('equips'));
        return view('jugadores.create');
    }

    // POST /jugadoras
    public function store(Request $request)
    {
        $jugadora = new Jugadora($request->all());
        $jugadora->save();

        return redirect()
            ->route('jugadores.index')
            ->with('success', 'Jugadora afegida correctament!');
    }

    // GET /jugadoras/{jugadora}/edit
    public function edit(Jugadora $jugadora)
    {
        return view('jugadores.edit', compact('jugadora'));
    }

    // PUT/PATCH /jugadoras/{jugadora}
    public function update(Request $request, Jugadora $jugadora)
    {
        $jugadora->update($request->all());

        return redirect()
            ->route('jugadoras.index')
            ->with('success', 'Jugadora actualitzada correctament!');
    }

    // DELETE /jugadoras/{jugadora}
    public function destroy(Jugadora $jugadora)
    {
        $jugadora->delete();

        return redirect()
            ->route('jugadores.index')
            ->with('success', 'Jugadora esborrada correctament!');
    }
}
