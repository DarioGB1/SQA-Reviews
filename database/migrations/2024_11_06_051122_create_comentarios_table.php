<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentariosTable extends Migration
{
    public function up()
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');       // ID del usuario, sin restricción de clave foránea
            $table->unsignedBigInteger('movie_id')->nullable(); // ID de la película, opcional
            $table->unsignedBigInteger('serie_id')->nullable(); // ID de la serie, opcional
            $table->text('contenido');                   // Contenido del comentario
            $table->timestamps();

            // Índices para mejorar la velocidad de las búsquedas
            $table->index('user_id');
            $table->index('movie_id');
            $table->index('serie_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comentarios');
    }
}
