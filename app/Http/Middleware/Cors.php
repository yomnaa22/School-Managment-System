<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cors
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
    //     if( app.get("env") === "production"  ) 
    //     {
       
    //        sess.cookie.secure = true;
    //        app.set("trust proxy", 1);
    //    }
//     if (r.Method == "OPTIONS") {
//         w.WriteHeader(http.StatusOK);
       
//  return $next($request)->header("Access-Control-Allow-Origin", '*')
//  ->header("Access-Control-Allow-Credentials", true)
//  ->header('Access-Control-Allow-Methods', 'GET,PUT,POST,DELETE,OPTIONS')
//  ->header("Access-Control-Allow-Headers", 'Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers');
//     }z

header.Add("Access-Control-Allow-Origin", "*");
header.Add("Access-Control-Allow-Methods", "DELETE, POST, GET, OPTIONS");
header.Add("Access-Control-Allow-Headers", "Content-Type, Authorization, X-Requested-With")



}
}
