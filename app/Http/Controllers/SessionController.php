<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function index() 
    {
        return view('auth.login');
    }

    public function store(Request $request) 
    {
        $validation = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt($validation)) {
            throw ValidationException::withMessages([
                'password' => 'Invalid email or password.',
            ]);
        }

        request()->session()->regenerate();

        return redirect('/home');
    }

    public function edit(string $username, Request $request)
    {
        $user = User::where('username', $username)->firstOrFail();
        $socials = ['facebook', 'instagram', 'github', 'linkedin', 'twitter'];

        if (Gate::denies('delete', $user)) {
            return redirect()->back();
        }
        
        return view('user.edit', compact('user', 'socials'));
    }

    public function update (string $username, Request $request)
    {
        $user = User::where('username', $username)->firstOrFail();

        if (Gate::denies('delete', $user)) {
            return redirect()->back();
        }

        $socials = ['facebook', 'instagram', 'github', 'linkedin', 'twitter'];
        $rules = ['name' => ['required', 'min:6']];
        
        foreach ($socials as $platform) {
            $rules["social_media_$platform"] = ['nullable', 'url'];
        }
        
        $socialMediaValidation = $request->validate($rules);
        $validation = $request->validate([
            'name' => ['required', 'min:6'],
            'bio' => ['nullable', 'min:30'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'email' => ['required', 'email', 
                Rule::unique('users')->whereNull('deleted_at')->ignore(Auth::user()->id)
            ],
        ]);
        
        $image_path = $user->avatar ?? null;
        $deleteAvatar = $request->boolean('delete_avatar');
        $hasNewAvatar = $request->hasFile('avatar');

        if ($deleteAvatar || $hasNewAvatar) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            if ($deleteAvatar) {
                $image_path = null;
            }
        }

        if ($hasNewAvatar) {
            $image_path = $request->file('avatar')->store('avatar', 'public');
        }

        $social_media = [];

        foreach ($socials as $platform) {
            if ($socialMediaValidation["social_media_$platform"]) {
                $social_media[$platform] = $socialMediaValidation["social_media_$platform"];
            }
        }

        $user->update([
            'name' => $validation['name'],
            'bio' => $validation['bio'],
            'email' => $validation['email'],
            'avatar' => $image_path,
            'social_media' => count($social_media) == 0 ? null : $social_media,
        ]);

        return redirect('/@' . $user->username)->with('success', [
            'title' => 'Profile Updated',
            'message' => 'Your profile information has been successfully updated.',
        ]);        
    }

    public function delete(string $username, Request $request) 
    {
        $user = User::where('username', $username)->firstOrFail();

        if (Gate::denies('delete', $user)) {
            return redirect()->back();
        }
        
        Auth::logout();

        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }
        $user->delete();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function destroy(Request $request) 
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function library()
    {
        $user = Auth::user();
        $liked = $user->likedPosts->load(['author', 'category', 'tags']);

        $liked = $liked->map(function ($post) {
            $post->formatted_date = $post->created_at->format('d M Y');
            return $post;
        });   

        return view('user.library', compact('liked'));
    }

    public function like(string $username, string $slug)
    {
        $user = User::where('username', $username)->firstOrFail();
        $post = $user->posts()->where('slug', $slug)->firstOrFail();

        /** @var \App\Models\User $current_user */
        $current_user = Auth::user();
        $current_user->toggleLike($post->id);

        return redirect()->back();
    }
}
