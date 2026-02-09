<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function index()
    {
        return Contacto::with(['usuarioContactador', 'usuarioContactado', 'propiedad'])->get();
    }

    public function store(Request $request)
    {
        $contacto = Contacto::create($request->all());
        return response()->json($contacto, 201);
    }

    public function show($id)
    {
        return Contacto::with(['usuarioContactador', 'usuarioContactado', 'propiedad'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $contacto = Contacto::findOrFail($id);
        $contacto->update($request->all());
        return response()->json($contacto, 200);
    }

    public function destroy($id)
    {
        Contacto::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
