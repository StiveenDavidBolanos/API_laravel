<?php

namespace App\Http\Controllers;

use App\Models\Imagen;
use Illuminate\Http\Request;
use App\Services\GoogleDriveService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImagenController extends Controller
{
    protected $googleDriveService;

    public function __construct(GoogleDriveService $googleDriveService)
    {
        $this->googleDriveService = $googleDriveService;
    }

    public function index()
    {
        //return Imagen::with('propiedad')->get();
        return Imagen::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'imagen' => 'required|image|max:102400', // Máximo 100MB
            'id_propiedad' => 'required|integer|exists:propiedades,id_propiedad',
        ]);

        try {
            $imagen = $request->imagen;
            $filename = $imagen->getClientOriginalName();
            $response = Storage::disk('google')->put($filename, File::get($imagen));



            $imagen = Imagen::create([
                'url' => $filename,
                'id_propiedad' => $request->id_propiedad,
            ]);

            return response()->json($imagen, 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al subir la imagen', 'error' => $th->getMessage()], 500);
        }
    }

    public function show($id)
    {
        //   return Imagen::with('propiedad')->findOrFail($id);
        $imagen = Imagen::findOrFail($id);
        $src = base64_encode(Storage::disk('google')->get($imagen->url));

        return response()->json(
            [
                'imagen' => $imagen,
                'src' => $src
            ],
            200
        );
    }

    public function update(Request $request, $id)
    {
        $imagen = Imagen::findOrFail($id);
        $imagen->update($request->all());
        return response()->json($imagen, 200);
    }

    public function destroy($id)
    {
        Imagen::findOrFail($id)->delete();
        return response()->json(null, 204);
    }

    /**
     * Muestra una imagen almacenada en Google Drive.
     * Ruta sugerida: GET /api/imagenes/ver/{filename}
     */
    public function mostrar($filename)
    {
        try {
            $stream = $this->googleDriveService->obtenerArchivo($filename);

            return response()->stream(function () use ($stream) {
                fpassthru($stream);
            }, 200,);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Imagen no encontrada o error de acceso'], 404);
        }
    }
}
