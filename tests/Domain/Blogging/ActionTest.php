<?php

use Domain\Blogging\Actions\CreatePost;
use Domain\Blogging\Actions\UpdatePost;
use Domain\Blogging\Models\Post;
use Domain\Blogging\ValueObjects\PostValueObject;
use Domain\Shared\Models\User;
use Illuminate\Support\Str;

it('can create a post from a value object and uuid', function () {
    User::factory()->create();

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

    expect($post)->toBeInstanceOf(Post::class);
});

it('can update a post from a value object and post model', function () {
    $user = User::factory()->create();
    $post = $user->posts()->create([
        'title' => 'Test',
        'description' => 'Test',
        'body' => 'Test',
        'published' => true
    ]);

    $object = new PostValueObject(
        title: 'Test de merde',
        body: $post->body,
        description: $post->description,
        published: $post->published
    );

    expect(UpdatePost::handle($object, $post))->toBeBool()->toBeTrue();
    expect($post->refresh())->title->toBe('Test de merde');
});
