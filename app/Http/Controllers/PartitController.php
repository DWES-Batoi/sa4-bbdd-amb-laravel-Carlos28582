<?php

namespace App\Http\Controllers;

use App\Models\Partit;
use App\Models\Estadi;
use App\Models\Equip;
use Illuminate\Http\Request;

class PartitController extends Controller
{
    // GET /partits
    public function index()
    {
        $partits = Partit::all();
        return view('partits.index', compact('partits'));
    }

    // GET /partits/{partit}
    public function show(Partit $partit)
    {
        return view('partits.show', compact('partit'));
    }

    // GET /partits/create
    public function create()
    {
        $estadis = Estadi::all();
        $equips = Equip::all();
        return view('partits.create', compact('estadis', 'equips'));
    }

    // POST /partits
    public function store(Request $request)
    {
        $partit = new Partit($request->all());
        $partit->save();

        return redirect()
            ->route('partits.index')
            ->with('success', 'Partit afegit correctament!');
    }

    // GET /partits/{partit}/edit
    public function edit(Partit $partit)
    {   
        $equips = Equip::all();
        $estadis = Estadi::all();
        return view('partits.edit', compact('equips', 'partit', 'estadis'));
    }

    // PUT/PATCH /partits/{partit}
    public function update(Request $request, Partit $partit)
    {
        $partit->update($request->all());

        return redirect()
            ->route('partits.index')
            ->with('success', 'Partit actualitzat correctament!');
    }

    // DELETE /partits/{partit}
    public function destroy(Partit $partit)
    {
        $partit->delete();

        return redirect()
            ->route('partits.index')
            ->with('success', 'Partit esborrat correctament!');
    }
}
