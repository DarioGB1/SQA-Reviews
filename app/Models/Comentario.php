<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',        // ID del usuario que hizo el comentario
        'movie_id',       // ID de la película, si aplica
        'serie_id',       // ID de la serie, si aplica
        'contenido',      // Texto del comentario
    ];
}
