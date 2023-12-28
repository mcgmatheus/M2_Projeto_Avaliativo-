<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function destroy($id)
    {
        try {
            $user = Auth::user();
            $userId = $user->id;
            $exercise = Exercise::findOrFail($id);
            if ($exercise && ($userId === $exercise->user_id)) {
                $exercise->delete();
                return response()->json([''], 204);}
            if ($exercise && ($exercise->user_id !== $userId)) {
                return response()->json(['message' => 'Acesso não autorizado'], 403);}

                //Implementar verificação de exercicio vinculado a um treino

        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => 'Exercício não encontrado'], 404);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }
}