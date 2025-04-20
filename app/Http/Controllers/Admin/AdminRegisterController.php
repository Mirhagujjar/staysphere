<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminRegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('admin.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6', // confirmed needs password_confirmation field
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);
    
        auth()->login($user);
    
        return redirect()->route('admin.dashboard');
    }
    


}






// namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\User;

// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Auth;

// class AdminRegisterController extends Controller
// {
//     public function showRegistrationForm()
//     {
//         return view('admin.register');
//     }

//     public function register(Request $request)
//     {
//         $this->validator($request->all())->validate();


//         $admin = User::create([
//             'name' => $request->name,
//             'email' => $request->email,
//             'password' => Hash::make($request->password),
//             'role' => 'admin', 
//         ]);

//         Auth::guard('admin')->login($admin);

//         return redirect()->route('admin.dashboard');
//     }

//     protected function validator(array $data)
//     {
//         return Validator::make($data, [
//             'name' => ['required'],
//             'email' => ['required', 'email', 'unique:users'],
//             'password' => ['required', 'min:8', 'confirmed'],
//         ]);
//     }
// }

