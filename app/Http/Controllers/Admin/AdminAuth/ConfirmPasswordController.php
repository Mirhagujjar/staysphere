<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller
{
    use ConfirmsPasswords;

    protected $redirectTo = '/admin/dashboard'; // Adjust as per your admin dashboard route

    public function __construct()
    {
        $this->middleware('auth:adminauth');
    }

    protected function guard()
    {
        return auth()->guard('adminauth');
    }
}
