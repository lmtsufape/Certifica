<?php

namespace App\Actions\Jetstream;

use Illuminate\Support\Facades\Gate;
use Laravel\Jetstream\Contracts\DeletesApiTokens;

class DeleteApiToken implements DeletesApiTokens
{
    /**
     * Delete the given API token.
     *
     * @param  mixed  $user
     * @param  mixed  $apiToken
     * @return void
     */
    public function delete($user, $apiToken)
    {
        Gate::forUser($user)->authorize('delete', $apiToken);

        $apiToken->delete();
    }
}
