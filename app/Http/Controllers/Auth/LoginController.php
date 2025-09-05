<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);

        $user = User::where('email', $credentials['email'])->first();

        if ($user && $user->is_service_account) {
            // Guardamos essa flag para saber na resposta
            $request->merge(['service_account_blocked' => true]);
            return false;
        }

        return $this->guard()->attempt(
            $credentials,
            $request->filled('remember')
        );
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        if ($request->has('service_account_blocked') && $request->get('service_account_blocked')) {
            throw ValidationException::withMessages([
                $this->username() => ['Contas de serviço não podem ser acessadas pela interface de login.'],
            ]);
        }

        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }
}
