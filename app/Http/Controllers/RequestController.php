<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as Solicitud; // Asegúrate de que el modelo exista y esté correctamente nombrado
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    // Método para listar todas las solicitudes del usuario autenticado
    public function index()
    {
        $solicitudes = Auth::user()->solicitudes ?? collect(); // Usa collect() para asegurar que no sea null
        return view('usuario.solicitudes.adopta', compact('solicitudes'));
    }


    // Método para mostrar una solicitud específica
    public function show($id)
    {
        $solicitud = Auth::user()->solicitudes()->findOrFail($id); // Verifica que la solicitud pertenezca al usuario autenticado
        return view('requests.show', compact('solicitud'));
    }

    // Método para mostrar el formulario de creación de una nueva solicitud
    public function create()
    {
        return view('requests.create');
    }

    // Método para almacenar una nueva solicitud en la base de datos
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        Auth::user()->solicitudes()->create($validatedData);

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud creada exitosamente');
    }

    // Método para mostrar el formulario de edición de una solicitud específica
    public function edit($id)
    {
        $solicitud = Auth::user()->solicitudes()->findOrFail($id);
        return view('requests.edit', compact('solicitud'));
    }

    // Método para actualizar una solicitud existente
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        $solicitud = Auth::user()->solicitudes()->findOrFail($id);
        $solicitud->update($validatedData);

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud actualizada exitosamente');
    }

    // Método para eliminar una solicitud específica
    public function destroy($id)
    {
        $solicitud = Auth::user()->solicitudes()->findOrFail($id);
        $solicitud->delete();

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud eliminada exitosamente');
    }
}
