<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function show()
    {
        $admin = Auth::user(); // Using users table
        return view('admin.profile', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Auth::user();

            $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $admin->id,
        'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'password' => 'nullable|min:6|confirmed',
    ]);

    $admin->name = $request->name;
    $admin->email = $request->email;

    if ($request->hasFile('profile_image')) {
        $file = $request->file('profile_image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/profile'), $filename);
        $admin->profile_image = $filename;
    }

    // Only update password if it's provided
    if ($request->filled('password')) {
        $admin->password = Hash::make($request->password);
    }

    $admin->save();

    return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
