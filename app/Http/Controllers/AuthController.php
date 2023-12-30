<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function store(Request $request){
        try {
            $data = $request->only('email', 'password');
            $request->validate([
                'email'=>'string|required',
                'password'=>'string|required'
            ]);
            $authenticated = Auth::attempt($data);
            if(!$authenticated){
                return response()->json(['message' => 'Login não autorizado. Credenciais Incorretas'], 401);;
            }
            $request->user()->tokens()->delete();
            $user = $request->user();
            $token = $request->user()->createToken('acess_token');
            return response()->json(['message' => 'Login realizado com sucesso','name' => $user->name, 'token'=>$token->plainTextToken], 201);

        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([''], 204);
    }
}