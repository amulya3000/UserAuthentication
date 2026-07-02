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
        
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in.');
        } 
        
       if($request ->is('admin')&& Auth::user()->role !== 'admin'){
        return redirect()->route('dashboard')->with('error', 'You do not have admin access.');
       }
       return $next($request);
        

        
    }  
    
}
