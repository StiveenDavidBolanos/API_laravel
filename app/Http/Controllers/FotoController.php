<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Imagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    public function index()
    {
        return Foto::with('usuario')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|max:102400', // Máximo 100MB
            'id_usuario' => 'required|integer|exists:usuarios,id_usuario',
        ]);

        try {
            $foto = $request->foto;
            $filename = $foto->getClientOriginalName();
            $response = Storage::disk('google')->put($filename, File::get($foto));



            $foto = Foto::create([
                'url' => $filename,
                'id_usuario' => $request->id_usuario,
            ]);

            return response()->json($foto, 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al subir la foto', 'error' => $th->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $foto = Foto::findOrFail($id);
        $src = base64_encode(Storage::disk('google')->get($foto->url));

        return response()->json(
            [
                'foto' => $foto,
                'src' => $src
            ],
            200
        );
        return Foto::with('usuario')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $foto = Foto::findOrFail($id);
        $foto->update($request->all());
        return response()->json($foto, 200);
    }

    public function destroy($id)
    {
        Foto::findOrFail($id)->delete();
        return response()->json(null, 204);
    }

    public function porUsuario($id)
    {
        $foto = Foto::where('id_usuario', $id)->latest()->first();

        if (!$foto) {
            return response()->json(['message' => 'Foto no encontrada'], 404);
        }

        try {
            $content = Storage::disk('google')->get($foto->url);
            $src = base64_encode($content);

            return response()->json(
                [
                    'foto' => $foto,
                    'src' => $src
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al obtener la foto', 'error' => $th->getMessage()], 500);
        }
    }
}
