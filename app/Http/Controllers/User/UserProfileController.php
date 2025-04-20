<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'nullable|string|min:6|confirmed',
        ]);
    
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
    
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/profile_images'), $filename);
            $user->profile_image = $filename;
        }
    
        if ($request->filled('password')) {
            $user->password = \Hash::make($request->password);
        }
    
        $user->save();
    
        return back()->with('success', 'Profile updated successfully!');
    }

    public function show()
    {
        $user = auth()->user(); // Get logged-in user
        return view('user.profile', compact('user'));
    }
    
    public function __construct()
    {
        $this->middleware('auth');
    }

}
