<?php

namespace App\Services;

use App\Models\Equip;
use App\Models\Partit;

class ClassificacioService
{
    /**
     * Retorna posició per equip: [equip_id => posicio]
     * posició 1 = millor
     */
    public function posicionsPerEquip(): array
    {
        $equips = Equip::all();

        // Inicialitza taula de stats
        $stats = [];
        foreach ($equips as $e) {
            $stats[$e->id] = [
                'equip_id' => $e->id,
                'punts' => 0,
                'gf' => 0,
                'gc' => 0,
                'dg' => 0,
            ];
        }

        $partits = Partit::all();

       foreach ($partits as $p) {
    $l = $p->equip_local_id;
    $v = $p->equip_visitant_id;

    // Validación
    if (!$l || !$v || !$p->resultat) {
        continue;
    }

    // Inicializar arrays
    if (!isset($stats[$l])) {
        $stats[$l] = ['equip_id' => $l, 'gf' => 0, 'gc' => 0, 'punts' => 0];
    }
    if (!isset($stats[$v])) {
        $stats[$v] = ['equip_id' => $v, 'gf' => 0, 'gc' => 0, 'punts' => 0];
    }

    // EXTRAER goles del resultat "2 - 1"
    $gols = explode('-', $p->resultat);
    if (count($gols) !== 2) continue;

    $gl = (int) trim($gols[0]); // gols local
    $gv = (int) trim($gols[1]); // gols visitant

    // Resto del código igual...
    $stats[$l]['gf'] += $gl;
    $stats[$l]['gc'] += $gv;
    $stats[$v]['gf'] += $gv;
    $stats[$v]['gc'] += $gl;

    if ($gl > $gv) {
        $stats[$l]['punts'] += 3;
    } elseif ($gl < $gv) {
        $stats[$v]['punts'] += 3;
    } else {
        $stats[$l]['punts'] += 1;
        $stats[$v]['punts'] += 1;
    }
}

        // dg
        foreach ($stats as &$row) {
            $row['dg'] = $row['gf'] - $row['gc'];
        }
        unset($row);

        // Ordena millor -> pitjor
        $rows = array_values($stats);
        usort($rows, function ($a, $b) {
            return
                $b['punts'] <=> $a['punts'] ?:
                $b['dg']    <=> $a['dg'] ?:
                $b['gf']    <=> $a['gf'] ?:
                $a['equip_id'] <=> $b['equip_id'];
        });

        // Converteix a [equip_id => pos]
        $posicions = [];
        foreach ($rows as $i => $row) {
            $posicions[$row['equip_id']] = $i + 1;
        }

        return $posicions;
    }
}


