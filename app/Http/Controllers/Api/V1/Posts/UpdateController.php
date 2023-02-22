<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Posts\UpdateRequest;
use App\Http\Resources\Api\V1\PostResource;
use App\Jobs\Posts\UpdatePost;
use Domain\Blogging\Factories\PostFactory;
use Domain\Blogging\Models\Post;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

final class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Post $post): JsonResponse
    {
        UpdatePost::dispatch(
            $post->id,
            PostFactory::create($request->validated())
        );

        // return
        return response()->json(
            new PostResource($post), Http::ACCEPTED->value
        );
    }
}
