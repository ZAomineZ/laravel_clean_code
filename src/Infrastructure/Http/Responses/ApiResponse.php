<?php

declare(strict_types=1);

namespace Infrastructure\Http\Responses;

use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

final class ApiResponse
{
    private static array $headers = [
        'Content-Type' => 'application/vnd.api+json'
    ];

    public static function handle(
        $data,
        null|int $status = null,
        array $headers = []
    ): JsonResponse
    {
        return new JsonResponse(
            $data,
            $status ?? Http::OK->value,
            array_merge(static::$headers, $headers)
        );
    }
}
