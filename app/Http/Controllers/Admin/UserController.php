<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->profile_photo) {
            Storage::delete($user->profile_photo);
        }

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully');
    }
}
