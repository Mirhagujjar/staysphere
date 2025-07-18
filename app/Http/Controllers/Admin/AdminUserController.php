<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $users = User::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->when($status, function ($query, $status) {
                if ($status == 'banned') {
                    $query->where('is_banned', true);
                } elseif ($status == 'active') {
                    $query->where('is_banned', false);
                }
            })
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }



    public function ban(User $user)
    {
        $user->update(['is_banned' => true]);
        return back()->with('success', 'User has been banned.');
    }

    public function unban(User $user)
    {
        $user->update(['is_banned' => false]);
        return back()->with('success', 'User has been unbanned.');
    }

    public function toggleBan($id)
    {
        $user = User::findOrFail($id);
        $user->is_banned = !$user->is_banned; // Toggle ban
        $user->save();

        return redirect()->back()->with('success', 'User ban status updated.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'User deleted permanently.');
    }

}
