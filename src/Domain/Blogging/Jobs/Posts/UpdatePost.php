<?php

declare(strict_types=1);

namespace Domain\Blogging\Jobs\Posts;

use Domain\Blogging\Aggregates\PostAggregate;
use Domain\Blogging\Models\Post;
use Domain\Blogging\ValueObjects\PostValueObject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class UpdatePost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $postID,
        public PostValueObject $object
    ) {}

    public function handle(): void
    {
        $post = Post::find($this->postID);

        PostAggregate::retrieve($post->uuid)
            ->updatePost($this->object, $post->id)
            ->persist();
    }
}
