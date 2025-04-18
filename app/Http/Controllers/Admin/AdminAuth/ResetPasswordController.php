<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/admin/dashboard';

    public function __construct()
    {
        $this->middleware('guest:adminauth');
    }

    protected function guard()
    {
        return Auth::guard('adminauth');
    }

    protected function broker()
    {
        return app('auth.password.broker')->broker('admins');
    }
}
