<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use Illuminate\Http\Request;

class TipoController extends Controller
{
    /**
     * Constructor para aplicar middleware de autenticación.
     * Esto asegura que se requiera un token válido para acceder.
     */
    // public function __construct()
    // {
    //     $this->middleware('auth:sanctum');
    // }

    /**
     * Retorna el listado de todos los tipos.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $tipos = Tipo::all();
        return response()->json($tipos, 200);
    }

    /**
     * Almacena un nuevo tipo en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $tipo = Tipo::create($request->all());

        return response()->json($tipo, 201);
    }

    /**
     * Muestra un tipo específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $tipo = Tipo::find($id);

        if (!$tipo) {
            return response()->json(['message' => 'Tipo no encontrado'], 404);
        }

        return response()->json($tipo, 200);
    }

    /**
     * Actualiza un tipo existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $tipo = Tipo::find($id);

        if (!$tipo) {
            return response()->json(['message' => 'Tipo no encontrado'], 404);
        }

        $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
        ]);

        $tipo->update($request->all());

        return response()->json($tipo, 200);
    }

    /**
     * Elimina un tipo de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $tipo = Tipo::find($id);

        if (!$tipo) {
            return response()->json(['message' => 'Tipo no encontrado'], 404);
        }

        $tipo->delete();

        return response()->json(['message' => 'Tipo eliminado'], 200);
    }
}
