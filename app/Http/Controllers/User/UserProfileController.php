<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

use App\Models\Reservation;
use App\Models\User;

class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

  

    public function show()
    {
        $user = User::find(Auth::id());
        $user = User::find(Auth::id());
        $reservations = Reservation::where('user_id', $user->id)->with('room')->get();
        return view('User.profile.show', compact('user', 'reservations'));
    }

    public function edit()
    {
        $user = User::find(Auth::id());
        return view('user.profile.edit', compact('user')); // Separate edit page
    }

   public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            // Password fields
            'current_password' => 'nullable|required_with:password|string',
            'password' => 'nullable|string|min:8|confirmed',
        ], [
            'password.min' => 'The new password must be at least 8 characters.',
            'password.confirmed' => 'The new password and confirmation do not match.',
            'current_password.required_with' => 'Current password is required when setting a new password.',
        ]);

        $user->name = $request->name;

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            if ($user->profile_image && File::exists(public_path('assets/profile_images/' . $user->profile_image))) {
                File::delete(public_path('assets/profile_images/' . $user->profile_image));
            }

            $file = $request->file('profile_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/profile_images'), $filename);
            $user->profile_image = $filename;
        }

        // Handle password change
        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'The current password you entered is incorrect.']);
            }

            $user->password = Hash::make($request->password);
        }

        // $user->save();

        return redirect()->route('user.profile.show')->with('success', 'Profile updated successfully!');
    }







   

    public function showProfile()
    {
        $user = Auth::user();
        $reservations = \App\Models\Reservation::where('user_id', Auth::id())->with('room')->get();
        return view('User.profile.show', compact('user', 'reservations'));
    }
    

}
