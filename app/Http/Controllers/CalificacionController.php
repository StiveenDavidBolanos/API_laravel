<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use Illuminate\Http\Request;

class CalificacionController extends Controller
{
    public function index()
    {
        $calificaciones = Calificacion::with(['usuarioCalificador', 'usuarioCalificado'])->get();
        return response()->json($calificaciones, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function store(Request $request)
    {
        $calificacion = Calificacion::create($request->all());
        return response()->json($calificacion, 201, [], JSON_UNESCAPED_UNICODE);
    }

    public function show($id)
    {
        $calificacion = Calificacion::with(['usuarioCalificador', 'usuarioCalificado', 'propiedad'])->findOrFail($id);
        return response()->json($calificacion, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function update(Request $request, $id)
    {
        $calificacion = Calificacion::findOrFail($id);
        $calificacion->update($request->all());
        return response()->json($calificacion, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function destroy($id)
    {
        Calificacion::findOrFail($id)->delete();
        return response()->json(null, 204, [], JSON_UNESCAPED_UNICODE);
    }
}
