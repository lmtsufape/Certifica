<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use App\Models\Colaborador;

class CheckGestorColaborador
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

        $colaborador = Colaborador::where('user_id', $request->user()->id)->first();

        if ($colaborador || $request->user()->perfil_id == 3) {
            return $next($request);
        }

        return redirect('/home')->with('error', 'Acesso não autorizado para gestores e colaboradores.');
    }
}

