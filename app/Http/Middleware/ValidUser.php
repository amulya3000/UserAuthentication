<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ValidUser
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        echo "<h3 class='text-sucess'>We are now in ValidUser Middleware.</h3>";
        
        if (Auth::check()) {
            return $next($request);
        } 
        
        return redirect()->route('login');
    }  
    public function terminate(Request $request, Response $responce){
        echo " <h3 class = 'text-danger'> We are now terminate ValideUser Middleware</h3>";
    }  
}
