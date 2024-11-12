<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitudes'; // Nombre de la tabla

    protected $fillable = [
        'id_user',
        'id_mascota',
        'estado',
        'comentarios',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user'); // Asegúrate de que esto sea correcto
    }

    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'id_mascota'); // Asegúrate de que esto sea correcto
    }
}
