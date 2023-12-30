<?php

namespace App\Http\Middleware;

use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class verifyUserAccountLimit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user_id = Auth::user()->id;;
        $planId = DB::table('users')->where('id', $user_id)->value('plan_id');
        $planLimit = DB::table('plans')->where('id', $planId)->value('limit');
        $count = Student::where('user_id', $user_id)->count();

        if($planLimit === null) return $next($request);

        $available = ($planLimit - $count);
        if($available <=0) return response()->json(['message' => 'O usuário atingiu o limite de alunos cadastrados'], 403);

        return $next($request);
    }
}
