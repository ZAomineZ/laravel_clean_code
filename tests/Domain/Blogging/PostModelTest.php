<?php

use Domain\Blogging\Models\Post;
use Illuminate\Support\Str;

it('sets the slug on the post when is created', function () {
    $title = 'Test Post';
    $slug = Str::slug($title);

    $post = Post::create([
        'title' => $title,
        'description' => 'Test Description',
        'body' => 'Test Body'
    ]);

    expect($post->slug)->toEqual($slug);
});
