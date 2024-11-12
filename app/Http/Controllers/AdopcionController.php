<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Solicitud;

class AdopcionController extends Controller
{
    //Vista a requisitos adopcion
    public function datos_adoptar($id)
    {
        $mascota = DB::table('mascotas')->where('id', $id)->first();

        if (!$mascota) {
            abort(404); // Mostrar error si no se encuentra la mascota
        }

        return view('usuario.galeria.aadoptar', ['mascota' => $mascota]); // Pasar la mascota a la vista
    }
    public function adoptar(Request $request)
    {
        // Validar el formulario
        $request->validate([
            'id_mascota' => 'required|exists:mascotas,id', // Asegúrate de que la mascota exista
        ]);

        // Verificar si ya existe una solicitud para este usuario y mascota
        $existingRequest = Solicitud::where('id_user', auth()->id())
            ->where('id_mascota', $request->id_mascota)
            ->where('estado', 'en revisión') // Puedes ajustar esto según tu lógica
            ->first();

        if ($existingRequest) {
            return redirect()->back()->with('error', 'Ya has enviado una solicitud para esta mascota.');
        }

        // Crear la nueva solicitud
        $solicitud = new Solicitud();
        $solicitud->id_user = auth()->id(); // Obtener el ID del usuario autenticado
        $solicitud->id_mascota = $request->id_mascota; // Guardar el ID de la mascota desde el formulario
        $solicitud->estado = 'en revisión'; // Estado inicial
        $solicitud->comentarios = $request->comentarios ?? null; // Campo opcional para comentarios

        // Guardar la solicitud en la base de datos
        $solicitud->save();

        // Redirigir con mensaje de éxito
        return redirect()->back()->with('success', '¡Solicitud de adopción enviada con éxito!');
    }

    //Ver solicitudes
    public function verSolicitudes()
    {
        // Obtener todas las solicitudes del usuario autenticado
        $solicitudes = Solicitud::where('id_user', auth()->id())->get();

        // Retornar la vista con las solicitudes
        return view('/usuario/solicitudes/adopta', compact('solicitudes'));
    }

}
