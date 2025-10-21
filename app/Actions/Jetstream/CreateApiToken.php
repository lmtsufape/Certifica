<?php

namespace App\Actions\Jetstream;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Contracts\CreatesApiTokens;
use Laravel\Jetstream\Events\ApiTokenCreated;
use Laravel\Jetstream\Jetstream;

class CreateApiToken implements CreatesApiTokens
{
    /**
     * Create a new API token.
     *
     * @param  mixed  $user
     * @param  string  $name
     * @param  array  $permissions
     * @return mixed
     */
    public function create($user, string $name, array $permissions = [])
    {
        Gate::forUser($user)->authorize('create', Jetstream::newApiTokenModel());

        Validator::make([
            'name' => $name,
            'permissions' => $permissions,
        ], $this->rules(), [
            'permissions.in' => 'Uma das permissões fornecidas é inválida.',
        ])->validateWithBag('createApiToken');

        $token = $user->tokens()->create([
            'name' => $name,
            'token' => hash('sha256', $plainTextToken = \Illuminate\Support\Str::random(40)),
            'abilities' => $permissions,
        ]);

        ApiTokenCreated::dispatch($token);

        return $token->forceFill([
            'plainTextToken' => $plainTextToken,
        ]);
    }

    /**
     * Get the validation rules for creating an API token.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'permissions' => ['array'],
            'permissions.*' => ['string', 'in:'.implode(',', Jetstream::$permissions)],
        ];
    }
}
