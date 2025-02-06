<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        // Load relationships based on user type
        if ($user->user_type === 'patient') {
            $user->load('patient');
        } elseif ($user->user_type === 'doctor') {
            $user->load('doctor');
        } elseif ($user->user_type === 'admin') {
            $user->load('admin');
        }

        return view('profile.personal', [
            'user' => $user,
            'patient' => $user->patient ?? null, // Pass patient data if applicable
            'doctor' => $user->doctor ?? null,   // Pass doctor data if applicable
            'admin' => $user->admin ?? null,     // Pass admin data if applicable
        ]);
    }



    /**
     * Update the user's profile information.
     */



    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     $request->user()->save();

    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Validate the incoming data
        $validatedData = $request->validate([
            'picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'ic' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string|in:male,female',
            'phone' => 'nullable|string|max:15',
        ]);

        // Update the User model for the phone number
        $user->update([
            'phone' => $validatedData['phone'],
        ]);

         // Handle role-specific updates
         if ($user->user_type === 'patient') {
            // Patient-specific updates
            $validatedPatientData = $request->validate([
                'picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'ic' => 'nullable|string|max:255',
                'address' => 'nullable|string|max:255',
                'date_of_birth' => 'nullable|date',
                'gender' => 'nullable|string|in:male,female',
            ]);

            // Handle profile picture upload
            $picturePath = $request->file('picture')
                ? $request->file('picture')->store('profile_pictures', 'public')
                : ($user->patient->picture ?? null);

            $user->patient()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'picture' => $picturePath,
                    'ic' => $validatedPatientData['ic'],
                    'address' => $validatedPatientData['address'],
                    'date_of_birth' => $validatedPatientData['date_of_birth'],
                    'gender' => $validatedPatientData['gender'],
                ]
            );
        }

        // No additional updates for doctors and admins beyond the phone number

        return redirect()->route('profile.personal')->with('success', 'Profile updated successfully.');
    }

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
}
