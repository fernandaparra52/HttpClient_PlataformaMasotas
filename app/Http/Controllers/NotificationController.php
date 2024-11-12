<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification; // Asegúrate de que este modelo exista
use Illuminate\Support\Facades\Auth; // Importa la clase Auth

class NotificationController extends Controller
{
    // Método para listar todas las notificaciones del usuario autenticado
    public function index()
    {
        // Obtiene el usuario autenticado
        $user = Auth::user(); // Cambia 'users' por 'user'

        // Supongamos que cada usuario tiene varias notificaciones
        $notifications = $user->notifications; // Aquí se asume que tienes una relación en el modelo User
        return view('notifications.index', compact('notifications'));
    }

    // Método para mostrar una notificación específica por su ID
    public function show($id)
    {
        // Obtiene el usuario autenticado
        $user = Auth::user(); // Cambia 'users' por 'user'

        // Buscar la notificación y verificar que pertenezca al usuario autenticado
        $notification = $user->notifications()->findOrFail($id); // Aquí se asume que tienes una relación en el modelo User
        return view('notifications.show', compact('notification'));
    }

    // Método para eliminar una notificación específica
    public function destroy($id)
    {
        // Obtiene el usuario autenticado
        $user = Auth::user(); // Cambia 'users' por 'user'

        // Buscar la notificación y verificar que pertenezca al usuario autenticado
        $notification = $user->notifications()->findOrFail($id); // Aquí se asume que tienes una relación en el modelo User
        $notification->delete();

        return redirect()->route('notificaciones')->with('success', 'Notificación eliminada exitosamente');
    }
}
