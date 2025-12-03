<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // 1. List all users
    public function index()
    {
        // Get all users, newest first
        $users = User::latest()->get(); 
        return view('users.index', ['users' => $users]);
    }

    // 2. Promote (or Demote) a user
    public function toggleAdmin(User $user)
    {
        // Prevent suicide (You can't remove your own admin status)
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot demote yourself!');
        }

        // Toggle the boolean (True -> False, False -> True)
        $user->is_employer = !$user->is_employer;
        $user->save();

        return back()->with('message', 'User role updated!');
    }

    // 3. Delete a user
    public function destroy(User $user)
    {
        // Prevent suicide
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot delete yourself!');
        }

        $user->delete();
        // Note: Their jobs will be auto-deleted because we used cascadeOnDelete() earlier!
        
        return back()->with('message', 'User deleted!');
    }
}