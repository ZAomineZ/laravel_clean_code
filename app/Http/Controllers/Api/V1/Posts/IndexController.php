<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Posts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\PostResource;
use Domain\Blogging\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JustSteveKing\StatusCode\Http;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

final class IndexController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $posts = QueryBuilder::for(subject: Post::class)
            ->allowedIncludes(['user'])
            ->allowedFilters(
                [
                    AllowedFilter::scope('published'),
                    AllowedFilter::scope('draft')
                ]
            )
            ->paginate(3);

        return response()->json(
            data: PostResource::collection($posts),
            status: Http::OK->value
        );
    }
}
