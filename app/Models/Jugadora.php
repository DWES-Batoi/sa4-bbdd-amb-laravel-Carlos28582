<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * MODEL JUGADORA
 */
class Jugadora extends Model
{
    use HasFactory;

    // ⚠️ Forzamos el nombre de la tabla
    protected $table = 'jugadores';

    protected $fillable = [
        'nom',
        'edat',
        'posicio',
        'equip_id',
    ];

    /**
     * Una jugadora pertany a un equip
     */
    public function equip()
    {
        return $this->belongsTo(Equip::class);
    }
}
