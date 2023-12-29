<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentReportController extends Controller
{
    public function reportWorkouts(Request $request)
    {
        //INSTALL DOMPDF
        //composer require barryvdh/laravel-dompdf
        try {
            $userId = Auth::user()->id;
            $studentId = $request->input('id');
            $studentData = Student::with('workouts.exercise')->findOrFail($studentId);
            if ($userId === $studentData->user_id) {
                $studentName = $studentData->name;
                $mondayWorkout = $studentData->workouts->where('day', 'SEGUNDA')->sortBy('created_at')->map(function ($workout) {
                    return [
                        'exercise_description' => $workout->exercise->description,
                        'repetitions' => $workout->repetitions,
                        'weight' => $workout->weight,
                        'break_time' => $workout->break_time,
                        'day' => $workout->day,
                        'observations' => $workout->observations,
                        'time' => $workout->time,
                    ];
                });
                $tuesdayWorkout = $studentData->workouts->where('day', 'TERCA')->sortBy('created_at')->map(function ($workout) {
                    return [
                        'exercise_description' => $workout->exercise->description,
                        'repetitions' => $workout->repetitions,
                        'weight' => $workout->weight,
                        'break_time' => $workout->break_time,
                        'day' => $workout->day,
                        'observations' => $workout->observations,
                        'time' => $workout->time,
                    ];
                });
                $WednesdayWorkout = $studentData->workouts->where('day', 'QUARTA')->sortBy('created_at')->map(function ($workout) {
                    return [
                        'exercise_description' => $workout->exercise->description,
                        'repetitions' => $workout->repetitions,
                        'weight' => $workout->weight,
                        'break_time' => $workout->break_time,
                        'day' => $workout->day,
                        'observations' => $workout->observations,
                        'time' => $workout->time,
                    ];
                });
                $thursdayWorkout = $studentData->workouts->where('day', 'QUINTA')->sortBy('created_at')->map(function ($workout) {
                    return [
                        'exercise_description' => $workout->exercise->description,
                        'repetitions' => $workout->repetitions,
                        'weight' => $workout->weight,
                        'break_time' => $workout->break_time,
                        'day' => $workout->day,
                        'observations' => $workout->observations,
                        'time' => $workout->time,
                    ];
                });
                $fridayWorkout = $studentData->workouts->where('day', 'SEXTA')->sortBy('created_at')->map(function ($workout) {
                    return [
                        'exercise_description' => $workout->exercise->description,
                        'repetitions' => $workout->repetitions,
                        'weight' => $workout->weight,
                        'break_time' => $workout->break_time,
                        'day' => $workout->day,
                        'observations' => $workout->observations,
                        'time' => $workout->time,
                    ];
                });
                $saturdayWorkout = $studentData->workouts->where('day', 'SABADO')->sortBy('created_at')->map(function ($workout) {
                    return [
                        'exercise_description' => $workout->exercise->description,
                        'repetitions' => $workout->repetitions,
                        'weight' => $workout->weight,
                        'break_time' => $workout->break_time,
                        'day' => $workout->day,
                        'observations' => $workout->observations,
                        'time' => $workout->time,
                    ];
                });
                $sundayWorkout = $studentData->workouts->where('day', 'DOMINGO')->sortBy('created_at')->map(function ($workout) {
                    return [
                        'exercise_description' => $workout->exercise->description,
                        'repetitions' => $workout->repetitions,
                        'weight' => $workout->weight,
                        'break_time' => $workout->break_time,
                        'day' => $workout->day,
                        'observations' => $workout->observations,
                        'time' => $workout->time,
                    ];
                });
                $pdf = PDF::loadView('pdfs.studentWorkoutsReport', [
                    'name' => $studentName,
                    'mondayWorkout' => $mondayWorkout,
                    'tuesdayWorkout' => $tuesdayWorkout,
                    'WednesdayWorkout' => $WednesdayWorkout,
                    'thursdayWorkout' => $thursdayWorkout,
                    'fridayWorkout' => $fridayWorkout,
                    'saturdayWorkout' => $saturdayWorkout,
                    'sundayWorkout' => $sundayWorkout
                ]);
                return $studentId;
            }
            if ($studentData->user_id !== $userId) {
                return response()->json(['message' => 'Acesso não autorizado'], 403);
            }
        } catch (ModelNotFoundException $exception) {
            if (!$studentId) return response()->json(['message' => 'É necessário informar um id de aluno'], 400);
            return response()->json(['message' => 'Aluno não encontrado'], 404);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }
}
