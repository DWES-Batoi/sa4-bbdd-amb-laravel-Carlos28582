<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JugadoraResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
   public function toArray($request): array
{
    return [
        'id' => $this->id,
        'nom' => $this->nom,
        'equip_id' => $this->equip_id,
        'posicio' => $this->posicio,
        'edat' => $this->edat,

        // Exemple si tens relació:
        // 'equip' => $this->whenLoaded('equip', fn () => $this->equip->nom),
    ];
}
}
