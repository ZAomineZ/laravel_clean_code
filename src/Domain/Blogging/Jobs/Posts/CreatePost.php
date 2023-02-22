<?php

declare(strict_types=1);

namespace Domain\Blogging\Jobs\Posts;

use Domain\Blogging\Aggregates\PostAggregate;
use Domain\Blogging\ValueObjects\PostValueObject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

final class CreatePost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public PostValueObject $object
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $uuid = Str::uuid();
        PostAggregate::retrieve($uuid->toString())
            ->createPost($this->object, 1)
            ->persist();
    }
}
