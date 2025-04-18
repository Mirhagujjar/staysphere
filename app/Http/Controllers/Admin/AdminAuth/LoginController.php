<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin/dashboard';

    public function __construct()
    {
        $this->middleware('guest:adminauth')->except('logout');
        $this->middleware('auth:adminauth')->only('logout');
    }

    protected function guard()
    {
        return Auth::guard('adminauth');
    }
}
