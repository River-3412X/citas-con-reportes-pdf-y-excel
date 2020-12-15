<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class Usuarios
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,$peticion="")
    {
        if(Auth::guard("responsable")->check()){
            if($peticion=="excel"){
                return $next($request);
            }
            else{
                $response=$next($request);
                return $response->header("Cache-Control","nocache, no-store, max-age=0, must-revalidate")
                                ->header("Pragma","no-cache")
                                ->header("Expires","Fri, 01 Jan 1990 00:00:00 GMT");
            }
        }
        else{
            if($peticion=="POST"){
                return redirect()->route("reload");
            }
            else{
                return redirect()->route("login");   
            }
        }
    }
}
