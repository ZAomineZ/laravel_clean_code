<?php

use JustSteveKing\StatusCode\Http;
use function Pest\Laravel\get;

it('tests the status code for static pages', function (string $page) {
    get($page)->assertStatus(Http::OK->value);
})->with(['/']);
