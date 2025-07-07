<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'slug', 'title', 'highlight',
        'thumbnail', 'category_id', 'user_id',
        'content', 'view'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tag(string $name)
    {
        $tag = Tag::firstOrCreate(['name' => strtolower($name)]);

        $this->tags()->attach($tag->id);
    }

    public function updateTag(array $tagNames)
    {
        $tagIds = collect($tagNames)->map(function ($name) {
            return Tag::firstOrCreate(['name' => strtolower($name)])->id;
        });
        
        $this->tags()->sync($tagIds);        
    }
}
