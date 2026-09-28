<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class RegionController extends Controller
{
    public function index(): JsonResponse
    {
        // Obtenemos las regiones activas y contamos sus agencias y rutas relacionadas
        $regiones = Region::withCount(['agencias', 'rutas'])
                          ->where('activo', true)
                          ->get();

        return response()->json([
            'success' => true,
            'data' => $regiones
        ]);
    }
}
