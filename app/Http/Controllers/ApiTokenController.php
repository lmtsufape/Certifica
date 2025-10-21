<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use App\Models\User;

class ApiTokenController extends Controller
{
    public function index($usuario_id)
    {
        $user = User::findOrFail($usuario_id);

        $this->authorize('viewTokens', $user);

        return view('profile.api-tokens', [
            'tokens' => $user->tokens,
            'user_id' => $user->id
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'token_name' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::find($request->user_id);

        $this->authorize('createToken', $user);

        $token = $user->createToken($request->token_name);

        return back()->with('status', 'Token criado com sucesso!')
            ->with('plainTextToken', $token->plainTextToken);
    }

    public function destroy($tokenId)
    {
        $token = PersonalAccessToken::findOrFail($tokenId);
        $user = $token->tokenable;

        $this->authorize('revokeToken', $user);

        $token->delete();

        return back()->with('status', 'Token revogado com sucesso!');
    }
}
