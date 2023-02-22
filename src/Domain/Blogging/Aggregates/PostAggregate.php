<?php

declare(strict_types=1);

namespace Domain\Blogging\Aggregates;

use Domain\Blogging\Events\PostWasCreated;
use Domain\Blogging\Events\PostWasUpdated;
use Domain\Blogging\ValueObjects\PostValueObject;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

final class PostAggregate extends AggregateRoot
{
    public function createPost(PostValueObject $object, int $userID, string $uuid): self
    {
        $this->recordThat(
            new PostWasCreated($object, $userID, $uuid)
        );

        return $this;
    }

    public function updatePost(PostValueObject $object, int $postID): self
    {
        $this->recordThat(
            new PostWasUpdated($object, $postID)
        );

        return $this;
    }
}
