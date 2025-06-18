<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check if user is admin or super_admin
            if (in_array($user->role, ['admin', 'super_admin'])) {

                //  Check if user is banned
                if ($user->is_banned) {
                    Auth::logout();
                    return back()->withErrors(['email' => 'Your admin account has been banned.']);
                }

                return redirect()->route('admin.dashboard');
            }

            //  Not an admin
            Auth::logout();
            return back()->withErrors(['email' => 'Invalid credentials or not an admin']);
        }

        return back()->withErrors(['email' => 'Invalid credentials or not an admin']);
    }

 
    public function logout(Request $request)
    {
        Auth::logout(); // ya Auth::guard('admin')->logout(); agar admin guard use ho raha ho

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/dashboard'); // ya koi aur redirect
    }
}
