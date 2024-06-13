<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;
use App\Models\Viajes;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function crearUsuario(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'telefono' => 'required|integer|unique:usuarios,telefono',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $usuario = Usuarios::create([
            'telefono' => $request->telefono,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
        ]);

        return response()->json(['message' => 'Usuario creado exitosamente', 'usuario' => $usuario], 201);
    }

    public function crearViaje(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'conductor' => 'required|integer|exists:usuarioConductores,cedula',
            'pasajero' => 'required|integer|exists:usuarios,telefono',
            'ubicacionPasajero' => 'required|string|max:255',
            'ubicacionDestino' => 'required|string|max:255',
            'estado' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $viaje = Viajes::create([
            'conductor' => $request->conductor,
            'pasajero' => $request->pasajero,
            'ubicacionPasajero' => $request->ubicacionPasajero,
            'ubicacionDestino' => $request->ubicacionDestino,
            'estado' => $request->estado,
        ]);

        return response()->json(['message' => 'Viaje creado exitosamente', 'viaje' => $viaje], 201);
    }
}
