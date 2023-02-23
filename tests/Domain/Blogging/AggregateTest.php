<?php

use Domain\Blogging\Aggregates\PostAggregate;
use Domain\Blogging\Events\PostWasCreated;
use Domain\Blogging\ValueObjects\PostValueObject;
use Domain\Shared\Models\User;
use Illuminate\Support\Str;

it('can create a post', function () {
    $user = User::factory()->create();

    // Value object
    $object = new PostValueObject(
        title: 'Test de merde',
        body: 'Test de merde body',
        description: 'Test de merde description',
        published: true
    );
    $uuid = Str::uuid()->toString();

    PostAggregate::fake()
        ->given(new PostWasCreated($object, $user->id, $uuid))
        ->when(function (PostAggregate $aggregate) use($object, $user, $uuid) {
            $aggregate->createPost($object, $user->id, $uuid);
        })
        ->assertRecorded(new PostWasCreated($object, $user->id, $uuid));
});
