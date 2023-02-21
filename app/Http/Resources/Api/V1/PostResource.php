<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->key,
            'type' => 'posts',
            'attributes' => [
                'title' => $this->title,
                'body' => $this->body,
                'description' => $this->description,
                'published' => $this->published
            ],
            'relationships' => [],
            'links' => [
                'self' => route('api:v1:posts:show', $this->key),
                'parent' => route('api:v1:posts:index')
            ]
        ];
    }
}
