<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    protected function resetPassword($user, $password)
    {
        $user->forceFill([
            'password' => $password, //Removed bcrypt
            'remember_token' => \Str::random(60),
        ])->save();

        \Auth::guard($this->getGuard())->login($user);
    }

    protected function getGuard()
    {
        return property_exists($this, 'guard') ? $this->guard : null;
    }
    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/admin/';
}
