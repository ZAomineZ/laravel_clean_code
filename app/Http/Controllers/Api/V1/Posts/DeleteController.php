<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Posts;

use App\Http\Controllers\Controller;
use Domain\Blogging\Jobs\Posts\DeletePost;
use Domain\Blogging\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use JustSteveKing\StatusCode\Http;

final class DeleteController extends Controller
{
    public function __invoke(Request $request, Post $post): Response
    {
        // Delete resource
        DeletePost::dispatch($post->id);

        return response(
            null,
            status: Http::ACCEPTED->value
        );
    }
}
