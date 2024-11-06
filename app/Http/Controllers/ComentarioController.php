<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    /**
     * Almacena un nuevo comentario en la base de datos.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'user_id' => 'required|integer',
            'comentario' => 'required|string',
            'movie_id' => 'nullable|integer',
            'serie_id' => 'nullable|integer',
        ]);

        // Verificar que uno de los campos `movie_id` o `serie_id` esté presente
        if (!$request->movie_id && !$request->serie_id) {
            return response()->json([
                'error' => 'Debe proporcionar un movie_id o serie_id'
            ], 422);
        }

        // Crear el comentario
        $comentario = Comentario::create([
            'user_id' => $request->user_id,
            'movie_id' => $request->movie_id,
            'serie_id' => $request->serie_id,
            'contenido' => $request->comentario,
        ]);

        // Responder con el comentario creado
        return response()->json([
            'message' => 'Comentario creado exitosamente',
            'data' => $comentario,
        ], 201);
    }

    /**
 * Lista los comentarios de una película específica.
 *
 * @param int $movie_id
 * @return \Illuminate\Http\JsonResponse
 */
public function show($movie_id)
{
    // Buscar comentarios asociados al movie_id
    $comentarios = Comentario::where('movie_id', $movie_id)->get();

    // Verificar si se encontraron comentarios
    if ($comentarios->isEmpty()) {
        return response()->json([
            'message' => 'No se encontraron comentarios para esta película.',
            'data' => []
        ], 404);
    }

    // Responder con los comentarios encontrados
    return response()->json([
        'message' => 'Comentarios encontrados',
        'data' => $comentarios
    ], 200);
}

}
