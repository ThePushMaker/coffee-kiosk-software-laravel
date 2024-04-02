<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistroRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegistroRequest $request): JsonResponse
    {
        // validar el registro
        $data = $request->validated();
        
        // crear el usuario
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
        
        // retornar respuesta
        return response()->json([
            'token' => $user->createToken('token')->plainTextToken,
            'user' => $user
        ], 201); 
    }

    public function login(Request $request)
    {
        
    }

    public function logout(Request $request)
    {
        
    }
}
