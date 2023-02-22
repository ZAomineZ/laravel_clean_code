<?php

declare(strict_types=1);

namespace Domain\Blogging\Aggregates;

use Domain\Blogging\Events\PostWasCreated;
use Domain\Blogging\ValueObjects\PostValueObject;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

final class PostAggregate extends AggregateRoot
{
    public function createPost(PostValueObject $object, int $userID): self
    {
        $this->recordThat(
            new PostWasCreated($object, $userID)
        );

        return $this;
    }
}
