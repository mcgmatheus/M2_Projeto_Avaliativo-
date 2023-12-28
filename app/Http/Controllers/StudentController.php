<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function store(Request $request)
    {
        try {
            if (count(array_diff(array_keys($request->all()), ['name', 'email', 'date_birth', 'cpf', 'contact', 'city', 'neighborhood', 'number', 'street', 'state', 'cep'])) > 0) {
                return response()->json(['message' => 'Informações inválidas'], 400);
            }
            $request->validate([
                'name' => 'string|required|max:255',
                'email' => 'string|required|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/|unique:students|max:255',
                'date_birth' => 'date|required|date_format:Y-m-d',
                'cpf' => 'string|required|unique:students|regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/|max:14',
                // cpf no formato xxx.xxx.xxx-xx
                'contact' => 'string|required|regex:/^\(\d{2}\) \d{5}-\d{4}$/|max:20',
                //contato no formato (xx) xxxxx-xxxx
                'cep' => 'string|max:20',
                'street' => 'string',
                'state' => 'string',
                'neighborhood' => 'string',
                'city' => 'string',
                'number' => 'string',
            ]);
            $data = $request->all();
            $user_id = Auth::user()->id;
            $student =  Student::create([...$data, 'user_id' => $user_id]);
            return response()->json($student, 201);
        } catch (Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }
    public function index(Request $request){
        try {
            $user_id = Auth::user()->id;
            $find = Student::where('user_id', $user_id)
            ->select('id', 'name', 'email', 'date_birth', 'cpf', 'contact', 'city', 'neighborhood', 'number', 'street', 'state', 'cep')->orderBy('name');

            if ($request->has('name')) {
                $name = $request->input('name');
                $find->where('name', 'ilike', "%$name%");
            }
            if ($request->has('cpf')) {
                $cpf = $request->input('cpf');
                $find->where('cpf', 'ilike', "%$cpf%");
            }
            if ($request->has('email')) {
                $email = $request->input('email');
                $find->where('email', 'ilike', "%$email%");
            }
            $student = $find->get();
            return response($student, 200);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }
    public function destroy($id)
    {
        try {
            $userId = Auth::user()->id;
            $student = Student::findOrFail($id);
            if ($student && ($userId === $student->user_id)) {
                $student->delete();
                return response()->json([''], 204);}
            if ($student && ($student->user_id !== $userId)) {
                return response()->json(['message' => 'Acesso não autorizado'], 403);}
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => 'Aluno não encontrado'], 404);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }
}