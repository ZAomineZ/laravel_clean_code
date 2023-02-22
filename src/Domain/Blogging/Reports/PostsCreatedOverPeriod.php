<?php

declare(strict_types=1);

namespace Domain\Blogging\Reports;

use Domain\Blogging\Events\PostWasCreated;
use Spatie\EventSourcing\EventHandlers\Projectors\EventQuery;
use Spatie\EventSourcing\StoredEvents\Models\EloquentStoredEvent;
use Spatie\Period\Period;

final class PostsCreatedOverPeriod extends EventQuery
{
    private int $totalPosts = 0;

    public function __construct(
        private readonly Period $period
    )
    {
        EloquentStoredEvent::query()
            ->whereEvent(
                'post-created'
            )
            ->whereDate(
                'created_at', '>=', $this->period->start()
            )
            ->whereDate(
                'created_at', '<=', $this->period->end()
            )
            ->each(fn(EloquentStoredEvent $event) => $this->apply($event->toStoredEvent()));
    }

    protected function applyPostWasCreated(PostWasCreated $postWasCreated): void
    {
        $this->totalPosts += 1;
    }

    public function totalPosts(): int
    {
        return $this->totalPosts;
    }
}
