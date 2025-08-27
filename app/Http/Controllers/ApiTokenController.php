<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiTokenController extends Controller
{
    /**
     * Mostra a página de gestão de tokens de API.
     */
    public function index()
    {
        return view('profile.api-tokens', [
            'tokens' => Auth::user()->tokens
        ]);
    }

    /**
     * Cria um novo token de API.
     */
    public function store(Request $request)
    {
        $request->validate([
            'token_name' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        $token = $user->createToken($request->token_name);

        // Redireciona de volta para a página com o novo token na sessão
        return back()->with('status', 'Token criado com sucesso!')
                     ->with('plainTextToken', $token->plainTextToken);
    }

    /**
     * Revoga (apaga) um token de API.
     */
    public function destroy($tokenId)
    {
        $user = Auth::user();

        // Encontra o token pelo ID e garante que ele pertence ao utilizador logado antes de apagar.
        $user->tokens()->where('id', $tokenId)->delete();

        return back()->with('status', 'Token revogado com sucesso!');
    }
}
