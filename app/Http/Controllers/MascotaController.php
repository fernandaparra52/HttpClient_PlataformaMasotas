<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MascotaController extends Controller
{
    // Método para listar todas las mascotas
    public function index()
    {
        $mascotas = DB::table("mascotas")
            ->where("estado_adopcion", "!=", "inactivo")
            ->get();

        return view("usuario.galeria.mascotas", ['mascotas' => $mascotas]); 
    }

    // Método para listado de mascotas
    public function listado()
    {
        $mascotas = DB::table("mascotas")
            ->where("estado_adopcion", "!=", "inactivo")
            ->get();

        return view("galeria", ['mascotas' => $mascotas]);
    }

    // Método para listado de mascotas para usuarios
    public function listado_usu()
    {
        $mascotas = DB::table("mascotas")
            ->where("estado_adopcion", "!=", "inactivo")
            ->get();

        return view("usuario.galeria.mascotas", ['mascotas' => $mascotas]);
    }

    // Método para ver los detalles de una mascota para usuarios
    public function detalle_usu($id)
    {
        $mascota = DB::table('mascotas')->where('id', $id)->first();

        if (!$mascota) {
            abort(404);
        }

        return view('usuario.galeria.detalle', ['mascota' => $mascota]);
    }


    
}
