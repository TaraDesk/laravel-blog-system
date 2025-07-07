<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('post.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'title' => ['required'],
            'highlight' => ['required', 'min:30'],
            'category' => ['required', 'exists:categories,id'],
            'tags' => ['required'],
            'thumbnail' => ['required', 'mimes:jpg,jpeg,png', 'max:2048'],
            'content' => ['required', 'min:100'],
        ]);

        $tags = explode(',', $request['tags']);
        $tags = array_map('trim', $tags);

        $slug = Str::slug($validation['title']) . '-' . time();
        $cleanContent = Purify::clean($request->content);
        $image_path = $request->file('thumbnail')->store('blog', 'public');

        $post = Post::create([
            'slug' => $slug, 
            'title' => $validation['title'], 
            'highlight' => $validation['highlight'], 
            'thumbnail' => $image_path, 
            'category_id' => $validation['category'], 
            'user_id' => Auth::user()->id,
            'content' => $cleanContent, 
            'view' => 0
        ]);

        foreach ($tags as $tag) {
            $post->tag($tag);
        }

        return redirect('/home')->with('success', [
            'title' => 'Post has been created',
            'message' => 'The post has been created successfully.'
        ]);
    }

    public function show(string $username, string $slug)
    {
        $user = User::where('username', $username)->firstOrFail();
        $post = $user->posts()->where('slug', $slug)->with([
                'author', 
                'tags', 
                'category', 
                'comments.user', 'comments.post'])
            ->firstOrFail();

        $post->view += 1;
        $post->save();

        $post->formatted_date = $post->created_at->format('d M Y');

        return view('post.show', compact('post'));
    }

    public function edit(string $username, string $slug)
    {
        $categories = Category::all();
        $user = User::where('username', $username)->firstOrFail();
        $post = $user->posts()->where('slug', $slug)->with(['author', 'tags', 'category', 'comments'])->firstOrFail();
        $tagString = $post->tags->pluck('name')->implode(', ');

        return view('post.edit', compact('categories', 'post', 'tagString'));
    }

    public function update(Request $request, string $username, string $slug)
    {
        $user = User::where('username', $username)->firstOrFail();
        $post = $user->posts()->where('slug', $slug)->firstOrFail();

        if (Gate::denies('update', $post)) {
            return redirect()->back();
        }

        $validation = $request->validate([
            'title' => ['required'],
            'highlight' => ['required', 'min:30'],
            'category' => ['required', 'exists:categories,id'],
            'tags' => ['required'],
            'thumbnail' => ['nullable', 'mimes:jpg,jpeg,png', 'max:2048'],
            'content' => ['required', 'min:100'],
        ]);

        if ($validation['title'] == $post->title) {
            $slug = $post->slug;
        } else {
            $slug = Str::slug($validation['title']) . '-' . time();
        }

        $tags = explode(',', $request['tags']);
        $tags = array_map('trim', $tags);

        $cleanContent = Purify::clean($request->content);

        $hasNewThumbnail = $request->hasFile('thumbnail');
        if ($hasNewThumbnail) {
            if ($post->thumbnail && Storage::disk('public')->exists($post->thumbnail)) {
                Storage::disk('public')->delete($post->thumbnail);

                $image_path = $request->file('thumbnail')->store('blog', 'public');
            }
        } else {
            $image_path = $post->thumbnail;
        }

        $post->update([
            'slug' => $slug,
            'title' => $validation['title'], 
            'highlight' => $validation['highlight'], 
            'thumbnail' => $image_path, 
            'category_id' => $validation['category'], 
            'content' => $cleanContent, 
        ]);

        $post->updateTag($tags);

        return redirect('/home')->with('success', [
            'title' => 'Your Post has been changed',
            'message' => 'The post has been updated successfully.'
        ]);
    }

    public function delete(string $username, string $slug)
    {
        $user = User::where('username', $username)->firstOrFail();
        $post = $user->posts()->where('slug', $slug)->with(['author', 'tags', 'category', 'comments'])->firstOrFail();

        if (Gate::denies('delete', $post)) {
            return redirect()->back();
        }
        
        if ($post->thumbnail && Storage::disk('public')->exists($post->thumbnail)) {
            Storage::disk('public')->delete($post->thumbnail);
        }

        $post->delete();

        return redirect('/home')->with('success', [
            'title' => 'Post has been deleted',
            'message' => 'Your post has been deleted successfully.'
        ]);
    }
}
