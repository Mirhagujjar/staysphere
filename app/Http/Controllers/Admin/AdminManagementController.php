<?php

// management for super  admin

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminManagementController extends Controller
{
    // Show all admins
  public function index(Request $request)
{
    $query = User::where('role', 'admin');

    // Search by name or email
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        });
    }

    // Filter by ban status
    if ($request->filled('status') && in_array($request->status, ['0', '1'])) {
        $query->where('is_banned', $request->status);
    }

    $admins = $query->paginate(10);

    return view('admin.super.admins.index', compact('admins'));
}




    // Show the form to create a new admin
    public function create()
    {
        return view('admin.super.admins.create');
    }

    // Store the new admin in database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            // Only reject emails that are already used by admins
        //    'email' => 'required|email|unique:users,email,NULL,id,role',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'admin', // Default role when created by super admin
        ]);

        return redirect()->route('admin.superadmin.list')->with('success', 'Admin created successfully.');
    }

    public function edit($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        return view('admin.super.admins.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $admin->name = $request->name;
        $admin->email = $request->email;

        // Optional: Update password if provided
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->route('admin.superadmin.list')->with('success', 'Admin updated successfully.');
    }

    public function destroy($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        $admin->delete();

        return redirect()->back()->with('success', 'Admin deleted successfully.');
    }

    public function toggleBan($id)
    {
        $admin = User::findOrFail($id);
        $admin->is_banned = !$admin->is_banned;
        $admin->save();

        return back()->with('success', $admin->is_banned ? 'Admin banned successfully.' : 'Admin unbanned successfully.');
    }

}
