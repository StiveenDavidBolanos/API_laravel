<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use Illuminate\Http\Request;

class CiudadController extends Controller
{
    public function index()
    {
        return Ciudad::with('propiedades')->get();
    }

    public function store(Request $request)
    {
        $ciudad = Ciudad::create($request->all());
        return response()->json($ciudad, 201);
    }

    public function show($id)
    {
        return Ciudad::with('propiedades')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $ciudad = Ciudad::findOrFail($id);
        $ciudad->update($request->all());
        return response()->json($ciudad, 200);
    }

    public function destroy($id)
    {
        Ciudad::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
