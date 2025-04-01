<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserPreference;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('dashboard.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['first_name', 'last_name', 'username', 'email', 'phone', 'bio']);

        if ($request->hasFile('image')) {
            $bannerImageName = 'profile_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/images'), $bannerImageName);

            $data['image'] = $bannerImageName;
        }

        if ($request->hasFile('banner_image')) {
            $bannerImageName = 'banner_' . time() . '.' . $request->file('banner_image')->getClientOriginalExtension();
            $request->file('banner_image')->move(public_path('uploads/images'), $bannerImageName);

            $data['banner_image'] = $bannerImageName;
        }

        $user->update($data);

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile')->with('success', 'Password updated successfully');
    }

    public function preferences()
    {
        $user = Auth::user();
        $preferences = $user->preference ?? new UserPreference();

        return view('dashboard.preferences', compact('user', 'preferences'));
    }

    public function updatePreferences(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'preferred_destinations' => 'nullable|array',
            'budget_range' => 'nullable|string|max:50',
            'travel_style' => 'nullable|string|max:50',
            'interests' => 'nullable|array',
        ]);

        $preferenceData = $request->only([
            'preferred_destinations',
            'budget_range',
            'travel_style',
            'interests',
        ]);

        // Create or update user preferences
        UserPreference::updateOrCreate(
            ['user_id' => $user->id],
            $preferenceData
        );

        return redirect()->route('profile.preferences')->with('success', 'Travel preferences updated successfully!');
    }
}
