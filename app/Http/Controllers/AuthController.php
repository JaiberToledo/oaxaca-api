<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->correo)->first();

        // Depuración temporal: revisa qué trae $user
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado con ese correo'], 404);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'error' => 'Contraseña no coincide con el hash almacenado'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'mensaje' => 'Inicio de sesión exitoso',
            'token' => $token,
            'usuario' => [
                'id' => $user->id,
                'nombre' => $user->name,
                'correo' => $user->email
            ]
        ], 200);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'phone'    => 'required|string|max:20',
            'password' => 'required|string|min:8',
            'role_id'  => 'required|integer|in:1,2,3',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'role_id'  => $request->role_id,
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'Usuario registrado con éxito',
            'user'    => $user
        ], 201);
    }
}