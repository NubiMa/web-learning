<?php
// app/Http/Controllers/ProfileController.php (FIXED & COMPLETE)

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit()
    {
        return view('user.profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update the user's profile information (INCLUDING PHOTO).
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'first_name' => ['sometimes', 'string', 'max:255'],
            'last_name' => ['sometimes', 'string', 'max:255'],
            'job_title' => ['sometimes', 'nullable', 'string', 'max:255'],
            'bio' => ['sometimes', 'nullable', 'string', 'max:240'],
            'profile_picture' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // 2MB max
        ]);

        // Combine first_name and last_name
        if ($request->has('first_name') || $request->has('last_name')) {
            $firstName = $request->input('first_name', '');
            $lastName = $request->input('last_name', '');
            $user->name = trim($firstName . ' ' . $lastName);
        }

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            try {
                // Delete old picture if exists
                if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                    Storage::disk('public')->delete($user->profile_picture);
                }

                // Store new picture with unique name
                $file = $request->file('profile_picture');
                $filename = 'profile_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('profile-pictures', $filename, 'public');
                
                $user->profile_picture = $path;
                
                \Log::info('Profile picture uploaded', ['path' => $path, 'user_id' => $user->id]);
            } catch (\Exception $e) {
                \Log::error('Profile picture upload failed', ['error' => $e->getMessage()]);
                return back()->with('error', 'Failed to upload profile picture: ' . $e->getMessage());
            }
        }

        // Update other fields
        if ($request->has('job_title')) {
            $user->job_title = $request->input('job_title');
        }

        if ($request->has('bio')) {
            $user->bio = $request->input('bio');
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    /**
     * Delete profile picture
     */
    public function deleteProfilePicture()
    {
        $user = Auth::user();

        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
            $user->profile_picture = null;
            $user->save();
        }

        return back()->with('success', 'Profile picture deleted successfully!');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = Auth::user();

        // Delete profile picture if exists
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}