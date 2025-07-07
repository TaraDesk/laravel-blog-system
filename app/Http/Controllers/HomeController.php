<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $categories = Category::all();
        $posts = Post::with(['author', 'tags', 'category'])->get();

        $posts = $posts->map(function ($post) {
            $post->formatted_date = $post->created_at->format('d M Y');
            return $post;
        });        

        return view('user.home', ['categories' => $categories, 'posts' => $posts]);
    }
}
