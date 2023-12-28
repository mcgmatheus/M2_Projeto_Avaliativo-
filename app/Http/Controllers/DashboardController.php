<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        try {
            $user_id = Auth::user()->id;

            $planId = DB::table('users')->where('id', $user_id)->value('plan_id');
            $planLimit = DB::table('plans')->where('id', $planId)->value('limit');
            $planType = DB::table('plans')->where('id', $planId)->value('description');

            $registered_students = DB::table('students')->where('user_id', $user_id)->count();
            $registered_exercises = DB::table('exercises')->where('user_id', $user_id)->count();
            if($planLimit === null){
                $remaining_estudants = 'Ilimitado';
            } else {
                $remaining_estudants = ($planLimit - $registered_students);
            }
            $data = [
                'registered_students' => $registered_students,
                'registered_exercises' => $registered_exercises,
                'current_user_plan'=>$planType,
                'remaining_estudants'=>$remaining_estudants
            ];
            return response()->json($data, 200);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }
}