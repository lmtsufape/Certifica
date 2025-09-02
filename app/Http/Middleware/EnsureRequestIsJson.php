<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureRequestIsJson
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Se a requisição não for POST, PUT, ou PATCH, ou se não tiver conteúdo, ignora a verificação.
        if (!in_array($request->getMethod(), ['POST', 'PUT', 'PATCH']) || !$request->getContent()) {
            return $next($request);
        }

        // Tenta decodificar o JSON.
        json_decode($request->getContent());

        // Se json_last_error() não for JSON_ERROR_NONE, significa que o JSON é inválido.
        if (json_last_error() !== JSON_ERROR_NONE) {
            // Retorna uma resposta de erro clara.
            return response()->json(['message' => 'O corpo da requisição contém um JSON malformado.'], 400); // 400 Bad Request
        }

        // Se o JSON for válido, continua para a próxima etapa (o controller).
        return $next($request);
    }
}
