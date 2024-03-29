<?php

namespace App\Http\Controllers;

use App\Mail\SendUserWelcomeEmail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function store(Request $request){
        try {
            if (count(array_diff(array_keys($request->all()), ['name', 'email', 'password', 'date_birth', 'cpf', 'plan_id'])) > 0) {
                return response()->json(['message' => 'Informações adicionais não permitidas'], 400);
            }
            $request->validate([
                'name'=>'required|string|max:255',
                'email'=>'required|email|unique:users,email',
                'password'=>'required|string|max:255',
                'date_birth'=>'required|date|date_format:Y-m-d',
                'cpf'=>'required|string|unique:users,cpf',
                'plan_id' => 'required|exists:plans,id'],
            );
            $data = $request->all();
            $user =  User::create($data);
            if ($user->plan_id === 1) {
                $planDescription = "Bronze";
                $planLimit = "10";
            } else if ($user->plan_id === 2) {
                $planDescription = "Prata";
                $planLimit = "20";
            } else {
                $planDescription = "Ouro";
                $planLimit = "Ilimitado";
            }
            Mail::to($user->email, $user->name)->send(new SendUserWelcomeEmail($user->name, $planDescription, $planLimit ));
            return response()->json($user, 201);
        } catch (Exception $exception) {
            return response()->json(['message'=> $exception->getMessage()],400);
        }
    }
}