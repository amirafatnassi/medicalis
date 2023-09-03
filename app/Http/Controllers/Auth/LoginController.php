<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        switch ($user->role_id) {
            case 1:
                return redirect()->intended('/administrateur');
            case 2:
                return redirect()->intended('/patient');
            case 3:
                return redirect()->intended('/medecin');
            case 4:
                return redirect()->intended('/coordinateur/dashboard');
            case 5:
                return redirect()->intended('/representant');
            case 6:
                return redirect()->intended('/coordinateurChef/dashboard');
            default:
                return redirect()->intended('/welcome');
        }
    }
}
