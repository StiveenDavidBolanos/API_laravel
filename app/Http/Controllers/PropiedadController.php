<?php

namespace App\Http\Controllers;

use App\Models\Propiedad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PropiedadController extends Controller
{
    public function index()
    {
        $propiedades = Propiedad::with(['ciudad', 'usuario', 'imagenes'])->get();

        foreach ($propiedades as $propiedad) {
            foreach ($propiedad->imagenes as $imagen) {
                try {
                    $imagen->src = base64_encode(Storage::disk('google')->get($imagen->url));
                } catch (\Throwable $e) {
                    $imagen->src = null;
                }
            }
        }

        return $propiedades;
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'id_ciudad' => 'required|integer|exists:ciudades,id_ciudad',
            'id_usuario' => 'required|integer|exists:usuarios,id_usuario',
            'idtipo' => 'required|integer|exists:tipos,idTipo',
            'direccion' => 'nullable|string'

        ]);

        try {
            $data = [
                'nombre'      => $request->nombre,
                'descripcion' => $request->descripcion,
                'direccion'   => $request->direccion ?? 'Sin dirección',
                'idtipo'      => $request->idtipo,
                'precio'      => $request->precio,
                'coordenada_x' => $request->coordenada_x,
                'coordenada_y' => $request->coordenada_y,
                'id_ciudad'   => $request->id_ciudad,
                'id_usuario'  => $request->id_usuario,
                'banos'       => $request->banos ?? false,
                'dormitorios' => $request->dormitorios ?? false,
                'bano_compartido' => $request->bano_compartido ?? false,
                'amoblado' => $request->amoblado ?? false,
                'dueño_residente' => $request->dueño_residente ?? false,
                'servicios_incluidos' => $request->servicios_incluidos ?? false,
                'cocina_separada' => $request->cocina_separada ?? false,
                'horario_limitado' => $request->horario_limitado ?? false,
                'aire_acondicionado' => $request->aire_acondicionado ?? false,
                'permite_mascotas' => $request->permite_mascotas ?? false,
                'corriente_220' => $request->corriente_220 ?? false,


            ];

            $propiedad = Propiedad::create($data);

            return response()->json($propiedad, 201, [], JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $e) {
            Log::error('Fallo en PropiedadController@store: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            return response()->json([
                'message' => 'Error interno al procesar la solicitud',
                'error' => $e->getMessage(),
            ], 500, [], JSON_UNESCAPED_UNICODE);
        }
    }

    public function show($id)
    {
        $propiedad = Propiedad::with(['ciudad', 'usuario', 'imagenes'])->findOrFail($id);

        foreach ($propiedad->imagenes as $imagen) {
            try {
                $imagen->src = base64_encode(Storage::disk('google')->get($imagen->url));
            } catch (\Throwable $e) {
                $imagen->src = null;
            }
        }

        return $propiedad;
    }

    public function update(Request $request, $id)
    {
        $propiedad = Propiedad::findOrFail($id);
        $propiedad->update($request->all());
        return response()->json($propiedad, 200);
    }

    public function destroy($id)
    {
        Propiedad::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
