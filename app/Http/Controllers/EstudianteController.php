<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function index()
    {
        $estudiantes = Estudiante::all();

        return response()->json($estudiantes);
    }

public function store(Request $request)
{
    $validatedData = $request->validate([
        'nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:estudiantes',
        'telefono' => 'required|string|max:15',
        'direccion' => 'required|string|max:255',
        'fecha_nacimiento' => 'required|date',
        'carrera' => 'required|string|max:255',
        'semestre' => 'required|integer|min:1|max:10',
    ]);

    $estudiante = Estudiante::create($validatedData);

    return response()->json($estudiante, 201); 
}


    public function show($id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return response()->json(['error' => 'Estudiante no encontrado'], 404);
        }

        return response()->json($estudiante);
    }

    public function update(Request $request, $id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return response()->json(['error' => 'Estudiante no encontrado'], 404);
        }

        $estudiante->update($request->all());

        return response()->json($estudiante);
    }

    public function destroy($id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return response()->json(['error' => 'Estudiante no encontrado'], 404);
        }

        $estudiante->delete();

        return response()->json(['message' => 'Estudiante eliminado correctamente']);
    }
}
