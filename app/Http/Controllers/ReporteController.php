<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    // GET /api/reportes
    public function index()
    {
        $reportes = Reporte::with(['reportante', 'reportado', 'propiedad', 'motivo'])->get();
        return response()->json($reportes, 200, [], JSON_UNESCAPED_UNICODE);
    }

    // GET /api/reportes/{id}
    public function show($id)
    {
        $reporte = Reporte::with(['reportante', 'reportado', 'propiedad', 'motivo'])->find($id);

        if (!$reporte) {
            return response()->json(['message' => 'Reporte no encontrado'], 404, [], JSON_UNESCAPED_UNICODE);
        }

        return response()->json($reporte, 200, [], JSON_UNESCAPED_UNICODE);
    }

    // POST /api/reportes
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_reportante' => 'required|exists:usuarios,id_usuario',
            'id_reportado' => 'required|exists:usuarios,id_usuario',
            'id_propiedad' => 'nullable|exists:propiedades,id_propiedad',
            'id_motivo' => 'required|exists:motivos,id_motivo',
            'descripcion' => 'nullable|string',
            'evidencia_url' => 'nullable|string|max:255',
            'activo' => 'boolean',
        ]);

        $validated['fecha'] = now();

        $reporte = Reporte::create($validated);

        return response()->json(['message' => 'Reporte registrado correctamente', 'data' => $reporte], 201, [], JSON_UNESCAPED_UNICODE);
    }

    // PUT /api/reportes/{id}
    public function update(Request $request, $id)
    {
        $reporte = Reporte::find($id);

        if (!$reporte) {
            return response()->json(['message' => 'Reporte no encontrado'], 404, [], JSON_UNESCAPED_UNICODE);
        }

        $validated = $request->validate([
            'id_motivo' => 'sometimes|exists:motivos,id_motivo',
            'descripcion' => 'nullable|string',
            'evidencia_url' => 'nullable|string|max:255',
            'activo' => 'boolean',
        ]);

        $reporte->update($validated);

        return response()->json(['message' => 'Reporte actualizado correctamente', 'data' => $reporte], 200, [], JSON_UNESCAPED_UNICODE);
    }

    // DELETE /api/reportes/{id}
    public function destroy($id)
    {
        $reporte = Reporte::find($id);

        if (!$reporte) {
            return response()->json(['message' => 'Reporte no encontrado'], 404, [], JSON_UNESCAPED_UNICODE);
        }

        $reporte->delete();

        return response()->json(['message' => 'Reporte eliminado correctamente'], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
