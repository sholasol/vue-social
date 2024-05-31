<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        // dd($user);

        return Inertia::render('Profile/View', [
            'mustVerifyEmail' => $user instanceof MustVerifyEmail,
            'status' => session('status'),
            'success' => session('success'),
            'user' => new UserResource($user),
        ]);
    }
    /**
     * Display the user's profile form.
     */
    // public function edit(Request $request): Response
    // {
    //     return Inertia::render('Profile/Edit', [
    //         'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
    //         'status' => session('status'),
    //     ]);
    // }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        //return Redirect::route('profile.edit');
        return back()->with('success', 'Your profile has been updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function updateImage(Request $request, User $user)
    {
        $data = $request->validate([
            'cover' => ['nullable', 'image'],
            'avatar' => ['nullable', 'image']
        ]);

        $user = $request->user();

        $avatar = $data['avatar'] ?? null;
        /**   @var \Illuminate\Http\UploadedFile $cover */
        $cover = $data['cover'] ?? null;
        $success = '';

        //process images
        if ($cover) {
            //delete existing cover image
            if ($user->cover_path) {
                Storage::disk('public')->delete($user->cover_path);
            }

            $path = $cover->store('user-' . $user->id, 'public');

            //save the new cover path
            $user->update([
                'cover_path' => $path
            ]);

            $success = 'Cover image updated successfully';
        }

        //save images
        if ($avatar) {
            //delete existing avatar image
            if ($user->avatar_path) {
                Storage::disk('public')->delete($user->avatar_path);
            }

            $path = $avatar->store('user-' . $user->id, 'public');

            //save the new avatar path
            $user->update([
                'avatar_path' => $path
            ]);

            $success = 'Profile image updated successfully';
        }


        //session('success', 'Cover image successfully updated');

        return back()->with('success', $success);
    }
}
