<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ExerciseController extends Controller
{
    public function store(Request $request)
    {
        try {
            if (count(array_diff(array_keys($request->all()), ['description'])) > 0) {
                return response()->json(['message' => 'Informações inválidas'], 400);
            }
            $request->validate([
                'description' => 'required|string|max:255',
            ]);
            $user_id = Auth::user()->id;
            if (DB::table('exercises')->where('user_id', $user_id)->where('description', $request->input('description'))->count() > 0) {
                return response()->json(['message' => 'Exercicio já cadastrado'], 409);
            }
            $data = $request->all();
            $exercise =  Exercise::create([...$data, 'user_id' => $user_id]);
            return response()->json($exercise, 201);
        } catch (Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }
}