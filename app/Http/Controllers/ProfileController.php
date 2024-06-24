<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user(); // Retrieve authenticated user

        // Update user's profile information
        $user->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old profile image if exists
            if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                Storage::disk('public')->delete($user->profile_image);
            }

            // Store new profile image
            $profileImage = $request->file('profile_image')->store('profile-images', 'public');
            $user->profile_image = $profileImage;
        }

        $user->save(); // Save user's changes

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     // Handle profile image upload
    //     if ($request->hasFile('profile_image')) {
    //         // Delete old profile image if exists
    //         if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
    //             Storage::disk('public')->delete($user->profile_image);
    //         }

    //         // Store new profile image
    //         $profileImage = $request->file('profile_image')->store('profile-images', 'public');
    //         $user->profile_image = $profileImage;
    //     }

    //     $request->user()->save();

    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Disable the user's account.
     */
    public function disable(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDisable', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Set a disabled flag or status on the user account
        $user->disabled = true; // Assuming you have a 'disabled' column in your users table
        $user->save();

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function audit()
    {
        $audits = Auth::user()->audits;
        return view('profile.audit', compact('audits'));
    }
}
