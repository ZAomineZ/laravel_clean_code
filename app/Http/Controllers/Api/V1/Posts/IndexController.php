<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Posts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\PostResource;
use Domain\Blogging\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JustSteveKing\StatusCode\Http;

final class IndexController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json(
            data: PostResource::collection(
                Post::published()->paginate(3)
            ),
            status: Http::OK->value
        );
    }
}
