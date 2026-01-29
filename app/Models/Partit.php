<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * MODEL PARTIT
 */
class Partit extends Model
{
    use HasFactory;

    protected $fillable = [
        'equip_local_id',
        'equip_visitant_id',
        'resultat',
        'estadi_id',
    ];

    /**
     * Estadi on es juga el partit
     */
    public function estadi()
    {
        return $this->belongsTo(Estadi::class);
    }

    /**
     * Equip local
     */
    public function equipLocal()
    {
        return $this->belongsTo(Equip::class, 'equip_local_id');
    }

    /**
     * Equip visitant
     */
    public function equipVisitant()
    {
        return $this->belongsTo(Equip::class, 'equip_visitant_id');
    }
}
