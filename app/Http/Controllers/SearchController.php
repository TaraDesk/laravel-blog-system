<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke()
    {
        $query = request('q');

        $posts = Post::with(['author', 'tags', 'category'])
            ->where('title', 'LIKE', "%$query%")
            ->get()
            ->each(function ($post) {
                $post->formatted_date = $post->created_at->format('d M Y');
            });

        $users = User::with('posts')
            ->where('name', 'LIKE', "%$query%")
            ->get()
            ->each(function ($user) {
                $user->formatted_date = $user->created_at->format('d M Y');
            });

        return view('post.search', compact('posts', 'users', 'query'));
    }
}
