<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        return Usuario::with(['ciudadProcedencia', 'ciudadResidencia'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'email'  => 'required|email|unique:usuarios,email',
            'telefono' => 'nullable|string',
            'contrasena' => 'required|string',
            'foto' => 'nullable|string',

            // nuevas validaciones
            'id_procedencia' => 'nullable|exists:ciudades,id_ciudad',
            'id_residencia'  => 'nullable|exists:ciudades,id_ciudad',
        ]);

        $usuario = Usuario::create($request->all());

        return response()->json($usuario, 201);
    }

    public function show($id)
    {
        return Usuario::with(['ciudadProcedencia', 'ciudadResidencia'])
            ->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'email' => "email|unique:usuarios,email,{$id},id_usuario",
            'id_procedencia' => 'nullable|exists:ciudades,id_ciudad',
            'id_residencia'  => 'nullable|exists:ciudades,id_ciudad',
        ]);

        $usuario->update($request->all());

        return response()->json($usuario, 200);
    }

    public function destroy($id)
    {
        Usuario::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
