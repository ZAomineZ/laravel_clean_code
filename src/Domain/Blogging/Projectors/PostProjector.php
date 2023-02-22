<?php

declare(strict_types=1);

namespace Domain\Blogging\Projectors;

use Domain\Blogging\Actions\CreatePost;
use Domain\Blogging\Actions\UpdatePost;
use Domain\Blogging\Events\PostWasCreated;
use Domain\Blogging\Events\PostWasUpdated;
use Domain\Blogging\Models\Post;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

final class PostProjector extends Projector
{
    public function onPostWasCreated(PostWasCreated $event): void
    {
        CreatePost::handle($event->object, $event->uuid);
    }

    public function onPostWasUpdated(PostWasUpdated $event)
    {
        UpdatePost::handle($event->object, Post::find($event->postID));
    }
}
