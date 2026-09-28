<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ruta extends Model
{
    protected $table = 'rutas';

    protected $fillable = [
        'origen',
        'destino',
        'duracion_estimada',
        'precio_base',
        'activo',
        'region_id'
    ];

    // Relación inversa: Una ruta pertenece a una región
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_id');
    }
}