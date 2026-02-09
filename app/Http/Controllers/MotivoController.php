<?php

namespace App\Http\Controllers;

use App\Models\Motivo;
use Illuminate\Http\Request;

class MotivoController extends Controller
{
    // GET /api/motivos
    public function index()
    {
        return response()->json(Motivo::all(), 200);
    }

    // GET /api/motivos/{id}
    public function show($id)
    {
        $motivo = Motivo::find($id);

        if (!$motivo) {
            return response()->json(['message' => 'Motivo no encontrado'], 404);
        }

        return response()->json($motivo, 200);
    }

    // POST /api/motivos
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $motivo = Motivo::create($validated);

        return response()->json(['message' => 'Motivo creado correctamente', 'data' => $motivo], 201);
    }

    // PUT /api/motivos/{id}
    public function update(Request $request, $id)
    {
        $motivo = Motivo::find($id);

        if (!$motivo) {
            return response()->json(['message' => 'Motivo no encontrado'], 404);
        }

        $validated = $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $motivo->update($validated);

        return response()->json(['message' => 'Motivo actualizado correctamente', 'data' => $motivo], 200);
    }

    // DELETE /api/motivos/{id}
    public function destroy($id)
    {
        $motivo = Motivo::find($id);

        if (!$motivo) {
            return response()->json(['message' => 'Motivo no encontrado'], 404);
        }

        $motivo->delete();

        return response()->json(['message' => 'Motivo eliminado correctamente'], 200);
    }
}
