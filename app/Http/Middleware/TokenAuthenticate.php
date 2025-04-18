<?php

namespace App\Http\Middleware;

use App\Helper\JWTToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        $token = $request->cookie('token');
   
        $tokenData = JWTToken::ReadToken($token);      
        // dd($tokenData);
        if( $tokenData == 'unauthorized'){
            return redirect('/userLogin');
        }else{

            $request->headers->set('email', $tokenData->userEmail);
            $request->headers->set('id', $tokenData->userID);
            return $next($request);
        }
    }
}
