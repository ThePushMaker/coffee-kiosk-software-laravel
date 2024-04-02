<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistroRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        
        // autenticar al usuario
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        
        // revisar el password
        if(!Auth::attempt($data)) {
            return response()->json([
                'errors' => ['El email o la contraseña son incorrectos']
            ], 422);
        }
    }

    public function logout(Request $request)
    {
        
    }
}
