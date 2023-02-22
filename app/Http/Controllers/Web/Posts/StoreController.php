<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Posts\StoreRequest;
use Domain\Blogging\Factories\PostFactory;
use Domain\Blogging\Jobs\Posts\CreatePost;
use Illuminate\Http\RedirectResponse;

final class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request): RedirectResponse
    {
        CreatePost::dispatch(
            PostFactory::create($request->validated())
        );

        return redirect()->route('home');
    }
}
