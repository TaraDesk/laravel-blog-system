<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __invoke(string $username)
    {   
        $user = User::where('username', $username)->firstOrFail();
        $posts = $user->posts()->with(['category', 'author', 'tags'])->get();

        $socials = [
            'facebook' => 'fab fa-facebook',
            'github' => 'fab fa-github',
            'instagram' => 'fab fa-instagram',
            'linkedin' => 'fab fa-linkedin',
            'twitter' => 'fab fa-twitter',
        ];

        return view('user.profile', compact('user', 'posts', 'socials'));
    }
}
