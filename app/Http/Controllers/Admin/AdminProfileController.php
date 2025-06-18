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

        // Validate inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'current_password' => 'nullable|required_with:password|string',
            'password' => 'nullable|string|min:8|confirmed',
        ], [
            'password.min' => 'The new password must be at least 8 characters.',
            'password.confirmed' => 'The new password and confirmation do not match.',
            'current_password.required_with' => 'Current password is required when setting a new password.',
        ]);

        $admin->name = $request->name;

        // Handle profile image
        if ($request->hasFile('profile_image')) {
            if ($admin->profile_image && File::exists(public_path('uploads/profile/' . $admin->profile_image))) {
                File::delete(public_path('uploads/profile/' . $admin->profile_image));
            }

            $file = $request->file('profile_image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile'), $filename);
            $admin->profile_image = $filename;
        }

        // Handle password change
        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $admin->password)) {
                return back()->withErrors(['current_password' => 'The current password you entered is incorrect.']);
            }

            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->route('admin.profile.show')->with('success', 'Profile updated successfully!');
    }







   



}
