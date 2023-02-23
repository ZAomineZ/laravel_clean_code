<?php

use Domain\Blogging\Actions\CreatePost;
use Domain\Blogging\Factories\PostFactory;
use Domain\Blogging\ValueObjects\PostValueObject;
use Illuminate\Support\Str;

it('can create a post from a value object', function () {
    $data = [
        'title' => 'Test',
        'description' => 'Test',
        'body' => 'Test',
        'published' => true
    ];

    $uuid = Str::uuid()->toString();

    $object = new PostValueObject(
        title: $data['title'],
        body: $data['body'],
        description: $data['description'],
        published: $data['published']
    );

    $post = CreatePost::handle($object, $uuid);

    expect($post);
});
