<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'edad',
        'sexo',
        'especie',
        'tamano',
        'estado_salud',
        'estado_adopcion',
        'descripcion',
        'foto1',
        'foto2',
        'foto3',
    ];

    // Aquí puedes agregar relaciones con otros modelos si es necesario
}
