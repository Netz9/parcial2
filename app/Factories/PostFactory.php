<?php
// app/Factories/PostFactory.php

namespace App\Factories;

use App\Models\Post;

class PostFactory implements PostFactoryInterface
{
    public function all()
    {
        return Post::all();
    }

    public function create(array $attributes)
    {
        return Post::create($attributes);
    }

    public function find($id)
    {
        return Post::findOrFail($id);
    }

    public function update($id, array $attributes)
    {
        $post = Post::findOrFail($id);
        $post->update($attributes);
        return $post;
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
    }
}
