<?php

namespace App\Http\Controllers;

use App\Models\Favorito;
use Illuminate\Http\Request;

class FavoritoController extends Controller
{
    public function index()
    {
        return Favorito::with(['usuario', 'propiedad'])->get();
    }

    public function store(Request $request)
    {
        $favorito = Favorito::create($request->all());
        return response()->json($favorito, 201);
    }

    public function show($id)
    {
        return Favorito::with(['usuario', 'propiedad'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $favorito = Favorito::findOrFail($id);
        $favorito->update($request->all());
        return response()->json($favorito, 200);
    }

    public function destroy($id)
    {
        Favorito::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
