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
        $admin = auth()->user(); // Get the currently logged-in admin
        return view('admin.profile.show', compact('admin')); // Separate show page
    }

    public function edit()
    {
        $admin = auth()->user(); // Get the currently logged-in admin
        return view('admin.profile.edit', compact('admin')); // Separate edit page
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
            // Delete old image if exists
            if ($admin->profile_image && File::exists(public_path('uploads/profile/' . $admin->profile_image))) {
                File::delete(public_path('uploads/profile/' . $admin->profile_image));
            }

            $file = $request->file('profile_image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile'), $filename);
            $admin->profile_image = $filename;
        }

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->route('admin.profile.show')->with('success', 'Profile updated successfully!');
    }





   



}
