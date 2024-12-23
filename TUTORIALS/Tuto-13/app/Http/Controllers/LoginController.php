<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // Define where to redirect users after login
    protected $redirectTo = '/dashboard';

    protected function redirectTo()
{
    return $this->redirectTo;  // Redirect to dashboard after login
}
}