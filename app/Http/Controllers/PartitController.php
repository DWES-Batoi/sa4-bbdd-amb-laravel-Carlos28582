<?php

namespace App\Http\Controllers;

use App\Models\Partit;
use App\Models\Estadi;
use App\Models\Equip;
use Illuminate\Http\Request;
use App\Events\PartitActualitzat;
use App\Services\ClassificacioService;

class PartitController extends Controller

{
    public function __construct(private ClassificacioService $classificacioService) {}
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
    $data = $request->validate([
        'equip_local_id' => ['required','exists:equips,id','different:equip_visitant_id'],
        'equip_visitant_id' => ['required','exists:equips,id'],
        'estadi_id' => ['required','exists:estadis,id'],
        'resultat' => ['required','string','max:10'],
    ]);

    // 1) posicions abans
    $abans = $this->classificacioService->posicionsPerEquip();

    // 2) actualitza el partit
    $partit->update($data);

    // 3) posicions després
    $despres = $this->classificacioService->posicionsPerEquip();

    // 4) calcula delta (+ = puja, - = baixa)
    $delta = [];
    foreach ($despres as $equipId => $posDespres) {
        $posAbans = $abans[$equipId] ?? $posDespres;
        $deltaPos = $posAbans - $posDespres;
        if ($deltaPos !== 0) {
            $delta[] = ['equip_id' => $equipId, 'delta' => $deltaPos];
        }
    }

    // 5) emet event (només si hi ha canvis)
    if (!empty($delta)) {
        event(new PartitActualitzat($delta));
    }

    return redirect()->route('partits.index')->with('success', 'Partit actualitzat.');
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
