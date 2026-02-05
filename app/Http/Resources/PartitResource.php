<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PartitResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'equip_local_id' => $this->equip_local_id,
            'equip_visitant_id' => $this->equip_visitant_id,
            'resultat' => $this->resultat,
            'estadi_id' => $this->estadi_id,
            
            // Relaciones (solo si están cargadas)
            'equip_local' => $this->whenLoaded('equipLocal', fn () => [
                'id' => $this->equipLocal->id,
                'nom' => $this->equipLocal->nom,
            ]),
            'equip_visitant' => $this->whenLoaded('equipVisitant', fn () => [
                'id' => $this->equipVisitant->id,
                'nom' => $this->equipVisitant->nom,
            ]),
            'estadi' => $this->whenLoaded('estadi', fn () => [
                'id' => $this->estadi->id,
                'nom' => $this->estadi->nom,
            ]),
            
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}