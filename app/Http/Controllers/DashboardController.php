<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index($id){
        try {
            $planId = DB::table('users')->where('id', $id)->value('plan_id');
            $planLimit = DB::table('plans')->where('id', $planId)->value('limit');
            $planType = DB::table('plans')->where('id', $planId)->value('description');
            return [
                'plan_id' => $planId,
                'current_user_plan'=>$planType,
                'planLimit' => $planLimit
            ];
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }
}