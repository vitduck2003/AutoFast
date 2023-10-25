<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckrRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user =  User::where('id',1)->get();
        
        if($user[0]->role_id == 3){
            return response()->json('ban trong admin');
        }
        if($user[0]->role_id == 2){
            return response()->json('ban trong staff');
        }
        if($user[0]->role_id == 1){
            return response()->json('ban trong user');
        }
        return $next($request);
    }
}
