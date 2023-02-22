<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Posts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\PostResource;
use Domain\Blogging\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JustSteveKing\StatusCode\Http;
use Spatie\QueryBuilder\QueryBuilder;

final class ShowController extends Controller
{
    public function __invoke(Request $request, Post $post): JsonResponse
    {
        $post = QueryBuilder::for($post)
            ->allowedIncludes(['user'])
            ->first();

        return response()->json(
            new PostResource($post),
            Http::OK->value
        );
    }
}
