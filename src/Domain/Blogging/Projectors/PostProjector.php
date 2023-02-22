<?php

declare(strict_types=1);

namespace Domain\Blogging\Projectors;

use Domain\Blogging\Actions\CreatePost;
use Domain\Blogging\Events\PostWasCreated;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

final class PostProjector extends Projector
{
    public function onPostWasCreated(PostWasCreated $event): void
    {
        CreatePost::handle($event->object);
    }
}
