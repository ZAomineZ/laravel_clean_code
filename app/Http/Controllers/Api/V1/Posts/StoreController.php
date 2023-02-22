<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Posts\StoreRequest;
use Domain\Blogging\Factories\PostFactory;
use Domain\Blogging\Jobs\Posts\CreatePost;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

final class StoreController extends Controller
{
    public function __invoke(StoreRequest $request): JsonResponse
    {
        CreatePost::dispatch(
            PostFactory::create($request->validated())
        );

        // Return
        return response()->json(null, status: Http::CREATED->value);
    }
}
