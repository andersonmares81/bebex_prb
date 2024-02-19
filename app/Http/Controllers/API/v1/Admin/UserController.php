<?php

namespace App\Http\Controllers\API\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    /**
     * Mostrar todos los usuarios.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = User::all();

        return response()->json([
            'status' => true,
            'data' => $users
        ]);
    }

    /**
     * Crear un nuevo usuario.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'NITUSUARIO' => 'string|max:22',
            'NOMUSUARIO' => 'string|max:50',
            'CODUSUARIO' => 'string|max:15|unique:usuarios',
            'CLAVEUSUARIO' => 'string|max:255',
            'ESTADOUSUARIO' => 'string|in:A,C,B',
            'CODEMPRESA' => 'string|max:20',
            'FECGRA' => 'date',
            'EMAIL' => 'email|max:80',
            'FECNAC' => 'date',
            'SEXO' => 'string|in:Femenino,Masculino',
            'AVATAR' => 'numeric|max:999',
            'numcelular' => 'string|max:10',
        ]);

        $user = User::create($validatedData);

        return response()->json([
            'status' => true,
            'message' => 'Usuario creado exitosamente',
            'data' => $user
        ], 201);
    }

    /**
     * Mostrar un usuario específico.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show($CODUSUARIO): JsonResponse
    {
        try {
            $user = User::where('CODUSUARIO', $CODUSUARIO)->firstOrFail();
            return response()->json([
                'status' => true,
                'data' => $user,
                'message' => 'Usuario encontrado exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error al buscar el usuario: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Editar un usuario existente.
     *
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(Request $request, $CODUSUARIO): JsonResponse
    {
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'NITUSUARIO' => 'string|max:22',
            'NOMUSUARIO' => 'string|max:50',
            'CLAVEUSUARIO' => 'string|max:255',
            'ESTADOUSUARIO' => 'string|in:A,C,B',
            'CODEMPRESA' => 'string|max:20',
            'FECGRA' => 'date',
            'EMAIL' => 'email|max:80',
            'FECNAC' => 'date',
            'SEXO' => 'string|in:Femenino,Masculino',
            'AVATAR' => 'numeric|max:999',
            'numcelular' => 'string|max:10',
        ]);

        try {
            $user = User::findOrFail($CODUSUARIO);

            unset($validatedData['id']);

            $user->update($validatedData);

            return response()->json([
                'status' => true,
                'message' => 'Usuario actualizado exitosamente',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error al actualizar el usuario: '.$e->getMessage(),
            ], 500);
        }
    }


    /**
     * Eliminar un usuario.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy($CODUSUARIO): JsonResponse
    {
        try {
            $user = User::where('CODUSUARIO', $CODUSUARIO)->firstOrFail();

            $user->delete();

            return response()->json([
                'status' => true,
                'message' => 'Usuario eliminado exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error al eliminar el usuario: '.$e->getMessage(),
            ], 500);
        }
    }
}
