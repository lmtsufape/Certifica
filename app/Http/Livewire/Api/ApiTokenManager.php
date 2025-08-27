<?php

namespace App\Http\Livewire\Api;

use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\Http\Livewire\ApiTokenManager as JetstreamApiTokenManager;

class ApiTokenManager extends JetstreamApiTokenManager
{
    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('api.api-token-manager');
    }
}
