<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class CommentController extends Controller
{
    public function store(Request $request, string $username, string $slug)
    {
        $validation = $request->validate([
            'content' => ['required', 'min:10']
        ]);

        $user = User::where('username', $username)->firstOrFail();
        $post = $user->posts()->where('slug', $slug)->with(['author', 'tags', 'category', 'comments'])->firstOrFail();

        Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $post->id,
            'content' => $validation['content']
        ]);

        return redirect()->back();
    }

    public function update(Request $request, string $username, string $slug, string $comment)
    {
        $user = User::where('username', $username)->firstOrFail();
        $post = $user->posts()->where('slug', $slug)->with('comments')->firstOrFail();
        $comment = $post->comments()->where('id', $comment)->firstOrFail();

        if (Gate::denies('update', $comment)) {
            throw ValidationException::withMessages([
                'comment' => 'You not authorized to change this comment',
            ]);
        }

        $request->validate([
            'content' => ['required', 'min:10']
        ]);

        $comment->content = $request['content'];
        $comment->save();

        return redirect()->back();
    }

    public function delete(string $username, string $slug, string $comment)
    {
        $user = User::where('username', $username)->firstOrFail();
        $post = $user->posts()->where('slug', $slug)->with('comments')->firstOrFail();
        $comment = $post->comments()->where('id', $comment)->with(['post', 'user'])->firstOrFail();

        if (Gate::denies('delete', $comment)) {
            throw ValidationException::withMessages([
                'comment' => 'You not authorized to delete this comment',
            ]);
        }

        $comment->delete();

        return redirect()->back();
    }
}
