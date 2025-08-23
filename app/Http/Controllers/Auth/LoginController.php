<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        // Check if user exists and is banned
        if ($user && $user->is_banned) {
            return back()->withErrors(['email' => 'Your account has been banned. Please contact support.']);
        }

        if (Auth::attempt($credentials)) {
            return $this->authenticated($request, Auth::user())
                ?: redirect()->intended($this->redirectPath());
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
        return redirect()->back();
    }




    protected function authenticated(Request $request, $user)
    {
        if ($user->role === 'super_admin' || $user->role === 'admin') {
            return redirect()->intended('/admin/dashboard');
        }
        
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->back();
    }

    /**
     * Get the post-login redirect path.
     *
     * @return string
     */
    protected function redirectTo()
    {
        // This is a fallback if authenticated() doesn't return a response
        return '/';
    }
}