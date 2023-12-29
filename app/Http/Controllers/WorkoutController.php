<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Workout;
use Exception;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    public function store(Request $request)
    {
        try {
            if (count(array_diff(array_keys($request->all()), ['student_id', 'exercise_id', 'repetitions', 'weight', 'break_time', 'day', 'observations', 'time'])) > 0) {
                return response()->json(['message' => 'Informações inválidas'], 400);
            }
            $request->validate([
                'student_id' => 'required|exists:students,id',
                'exercise_id' => 'required|exists:exercises,id',
                'repetitions' => 'required|integer',
                'weight' => 'required|numeric',
                'break_time' => 'required|integer',
                'day' => 'required|string|in:SEGUNDA,TERCA,QUARTA,QUINTA,SEXTA,SABADO,DOMINGO',
                'observations' => 'nullable|string',
                'time' => 'required|integer',
            ]);
            $data = $request->all();
            $findExercise = Workout::where('student_id', $data['student_id'])->where('day', $data['day'])->where('exercise_id', $data['exercise_id'])->exists();
            if ($findExercise) {
                return response()->json(['message' => 'Exercício já cadastrado para esse dia'], 409);
            }
            $workout =  Workout::create($data);
            return response()->json($workout, 201);
        } catch (Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }
    public function show(Request $request)
    {
        $studentId = $request->input('id');
        $studentData = Student::with('workouts.exercise')->find($studentId);

        $data = [
            'student_id' => $studentData->id,
            'student_name' => $studentData->name,
            'workouts' => [
                'SEGUNDA' => $studentData->workouts->where('day', 'SEGUNDA')->map(function ($workout) {
                    return [
                        'id' => $workout->id,
                        'exercise_id' => $workout->exercise_id,
                        'exercise_description' => $workout->exercise->description,
                        'repetitions' => $workout->repetitions,
                        'weight' => $workout->weight,
                        'break_time' => $workout->break_time,
                        'day' => $workout->day,
                        'observations' => $workout->observations,
                        'time' => $workout->time,
                        'created_at' => $workout->created_at,
                    ];
                }),
            ],
        ];

        return $studentData;
    }
}
