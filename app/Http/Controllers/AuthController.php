<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegistroRequest;

class AuthController extends Controller
{

    public function register(RegistroRequest $request){
        $data = $request->validated();

        // Crear el usuario
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        // Retornar una respuesta
        return [
            'token' => $user->createToken('token')->plainTextToken,
            'user' => $user,
        ];
    }

    public function login(LoginRequest $request){
        // return 'Desde login';
        $data = $request->validated();
        
        // Revisar password
        if (!Auth::attempt($data)) {
            return response([
                'errors' => ['El email o password son incorrectos'],
            ], 422);
        }
        // Autenticar al usuario
        return [
            'token' => Auth::user()->createToken('token')->plainTextToken,
            'user' => Auth::user(),
        ];
    }


    public function logout(Request $request){
        // return 'logout...';
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return [
            'user' => null
        ];
    }
}
