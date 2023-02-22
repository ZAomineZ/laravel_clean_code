<?php

declare(strict_types=1);

namespace Domain\Blogging\Jobs\Posts;

use Domain\Blogging\ValueObjects\PostValueObject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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
        \Domain\Blogging\Actions\CreatePost::handle(
          $this->object
        );
    }
}
