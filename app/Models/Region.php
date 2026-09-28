<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    // Indicamos explícitamente el nombre de la tabla en la base de datos
    protected $table = 'regiones';

    // Definimos los campos que se pueden llenar de forma masiva
    protected $fillable = [
        'nombre', 
        'slug', 
        'descripcion', 
        'imagen', 
        'color', 
        'activo'
    ];

    // Relación: Una región tiene muchas agencias
    public function agencias(): HasMany
    {
        return $this->hasMany(Agencia::class, 'region_id');
    }

    // Relación: Una región tiene muchas rutas
    public function rutas(): HasMany
    {
        return $this->hasMany(Ruta::class, 'region_id');
    }
}