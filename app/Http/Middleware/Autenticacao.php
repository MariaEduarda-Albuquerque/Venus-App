<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Autenticacao
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('id')) {
            return redirect('/')->with('erro', 'Você precisa estar logado para acessar essa página.');
        }

        return $next($request);
    }
}
