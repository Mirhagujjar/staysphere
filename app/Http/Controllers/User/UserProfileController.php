<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

use App\Models\Reservation;

class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

  

    public function show()
    {
        $user = Auth::user();
        $reservations = Reservation::where('user_id', $user->id)->with('room')->get();
        return view('User.profile.show', compact('user', 'reservations'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('user.profile.edit', compact('user')); // Separate edit page
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('profile_image')) {
            // Remove old image
            if ($user->profile_image && File::exists(public_path('assets/profile_images/' . $user->profile_image))) {
                File::delete(public_path('assets/profile_images/' . $user->profile_image));
            }

            $file = $request->file('profile_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/profile_images'), $filename);
            $user->profile_image = $filename;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.profile.show')->with('success', 'Profile updated successfully!');
    }





   

    public function showProfile()
    {
        $user = auth()->user();
        $reservations = \App\Models\Reservation::where('user_id', auth()->id())->with('room')->get();
        return view('User.profile.show', compact('user', 'reservations'));
    }

}
