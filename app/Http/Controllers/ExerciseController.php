<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExerciseController extends Controller
{
    public function store(Request $request)
    {
        try {
            if (count(array_diff(array_keys($request->all()), ['description', 'user_id'])) > 0) {
                return response()->json(['message' => 'Informações inválidas'], 400);
            }
            $request->validate([
                'description' => 'required|string|max:255',
                'user_id'=>'integer|required'
            ]);
            $searchId = $request->input('user_id');
            $searchExercise = $request->input('description');
            if (DB::table('exercises')->where('user_id', $searchId)->where('description', $searchExercise)->count() > 0) {
                return response()->json(['message' => 'Exercicio já cadastrado'], 409);
            }
            $data = $request->all();
            $exercise =  Exercise::create($data);
            return response()->json($exercise, 201);
        } catch (Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }
    public function index(){
        try {
            $user = Auth::user();
            $userId = $user->id;
            $allExercises = Exercise::where('user_id', $userId)->select('id', 'description')->get();
            return response($allExercises, 200);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }
}