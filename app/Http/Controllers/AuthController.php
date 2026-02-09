<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use App\Models\Imagen;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:usuarios',
                'contrasena' => 'required|string|min:8',
                'telefono' => 'nullable|string|max:20',
                'fecha_nacimiento' => 'required|date|date_format:Y-m-d',
                'id_procedencia' => 'required|integer',
                'id_residencia' => 'required|integer'

            ]);

            $usuario = Usuario::create([
                'nombre' => $request->nombre,
                'email' => $request->email,
                'contrasena' => Hash::make($request->contrasena),
                'telefono' => $request->telefono,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'id_procedencia' => $request->id_procedencia,
                'id_residencia' => $request->id_residencia
            ]);

            $token = $usuario->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                // Construimos el array manualmente para evitar errores de memoria en la serialización
                'user' => [
                    'id_usuario' => $usuario->id_usuario,
                    'nombre' => $usuario->nombre,
                    'email' => $usuario->email,
                    'telefono' => $usuario->telefono,
                    'fecha_nacimiento' => $usuario->fecha_nacimiento,
                    'id_procedencia' => $usuario->id_procedencia,
                    'id_residencia' => $usuario->id_residencia
                ],
            ], 201, [], JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error al registrar el usuario',
                'error' => $th->getMessage()
            ], 500, [], JSON_UNESCAPED_UNICODE);
        }
    }

    public function login(Request $request)
    {
        //   dd($request->all());

        try {
            $request->validate([
                'email' => 'required|email',
                'contrasena' => 'required',
            ]);

            $usuario = Usuario::where('email', $request->email)->first();

            if (! $usuario || ! Hash::check($request->contrasena, $usuario->contrasena)) {
                throw ValidationException::withMessages([
                    'email' => ['Las credenciales proporcionadas son incorrectas.'],
                ]);
            }

            $token = $usuario->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => [
                    'id_usuario' => $usuario->id_usuario,
                    'nombre' => $usuario->nombre,
                    'email' => $usuario->email,
                    'telefono' => $usuario->telefono,
                    'fecha_nacimiento' => $usuario->fecha_nacimiento,
                    'id_procedencia' => $usuario->id_procedencia,
                    'id_residencia' => $usuario->id_residencia
                ],
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error en el inicio de sesión',
                'error' => $th->getMessage()
            ], 500, [], JSON_UNESCAPED_UNICODE);
        }
    }

    public function logout(Request $request)
    {
        // Elimina el token actual que se usó para la petición
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Sesión cerrada correctamente'], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        try {
            $request->validate([
                'nombre' => 'sometimes|string|max:255',
                'email' => 'sometimes|string|email|max:255|unique:usuarios,email,' . $user->id_usuario . ',id_usuario',
                'contrasena' => 'sometimes|string|min:8',
                'telefono' => 'nullable|string|max:20',
                'fecha_nacimiento' => 'sometimes|date|date_format:Y-m-d',
                'id_procedencia' => 'sometimes|integer',
                'id_residencia' => 'sometimes|integer'
            ]);

            $data = $request->only(['nombre', 'email', 'telefono', 'fecha_nacimiento', 'id_procedencia', 'id_residencia']);

            if ($request->filled('contrasena')) {
                $data['contrasena'] = Hash::make($request->contrasena);
            }

            $user->update($data);

            $user->load('fotos');
            foreach ($user->fotos as $foto) {
                try {
                    $foto->src = base64_encode(Storage::disk('google')->get($foto->url));
                } catch (\Throwable $e) {
                    $foto->src = null;
                }
            }

            return response()->json([
                'message' => 'Usuario actualizado correctamente',
                'user' => [
                    'id_usuario' => $user->id_usuario,
                    'nombre' => $user->nombre,
                    'email' => $user->email,
                    'telefono' => $user->telefono,
                    'fecha_nacimiento' => $user->fecha_nacimiento,
                    'id_procedencia' => $user->id_procedencia,
                    'id_residencia' => $user->id_residencia,
                    'fotos' => $user->fotos
                ]
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error al actualizar el usuario',
                'error' => $th->getMessage()
            ], 500, [], JSON_UNESCAPED_UNICODE);
        }
    }

    public function me(Request $request)
    {
        $user = $request->user();
        $user->load('fotos');

        foreach ($user->fotos as $foto) {
            try {
                $foto->src = base64_encode(Storage::disk('google')->get($foto->url));
            } catch (\Throwable $e) {
                $foto->src = null;
            }
        }

        return response()->json([
            'id_usuario' => $user->id_usuario,
            'nombre' => $user->nombre,
            'email' => $user->email,
            'telefono' => $user->telefono,
            'fecha_nacimiento' => $user->fecha_nacimiento,
            'id_procedencia' => $user->id_procedencia,
            'id_residencia' => $user->id_residencia,
            'fotos' => $user->fotos
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
