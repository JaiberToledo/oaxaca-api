<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Agencia extends Model
{
    protected $table = 'agencias';

    protected $fillable = [
        'nombre',
        'rnt_cedula',
        'email_contacto',
        'telefono',
        'activo',
        'region_id'
    ];

    // Relación inversa: Una agencia pertenece a una región
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_id');
    }
}