<?php

use Domain\Blogging\Models\Post;
use Domain\Shared\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use JustSteveKing\StatusCode\Http;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\patch;
use function Pest\Laravel\post;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertNull;

beforeEach(fn() => $this->post = Post::factory()->create());

it('tests the index route for posts', function () {
    get(route('api:v1:posts:index'))
        ->assertStatus((int)Http::OK->value)
        ->assertJson(function (AssertableJson $json) {
            $json->has(1)
                ->first(function (AssertableJson $json) {
                    $json->where('id', $this->post->key)
                        ->where('attributes.title', $this->post->title)
                        ->etc();
                });
        });
});

it('tests the ability to create a new post', function () {
    User::factory()->create();

    $data = [
        'title' => 'Test Post',
        'description' => 'Test Post Description',
        'body' => 'Test Post Body'
    ];
    $valueStatus = Http::CREATED->value;
    $testResponse = post(route('api:v1:posts:store'), $data)
        ->assertStatus($valueStatus);
    $content = json_decode($testResponse->getContent(), true);
    expect($content)->toBeEmpty();
});

it('tests the ability to show an existing post', function () {
    get(route('api:v1:posts:show', $this->post->key))
        ->assertStatus((int)Http::OK->value)
        ->assertJson(function (AssertableJson $json) {
            $json->where('id', $this->post->key)
                ->where('attributes.title', $this->post->title)
                ->missing('relationships.user')
                ->etc();
        });
});

it('tests the ability to show an existing post with the user information', function () {
    get("/api/v1/posts/{$this->post->key}?include=user")
        ->assertStatus((int)Http::OK->value)
        ->assertJson(function (AssertableJson $json) {
            $json->where('id', $this->post->key)
                ->where('attributes.title', $this->post->title)
                ->has('relationships.user')
                ->where('relationships.user', null)
                ->etc();
        });
});

it('tests the ability to update a post', function () {
    $newTitle = 'Test title';

    expect($this->post)
        ->title
        ->toBe($this->post->title);

    User::factory()->create();

    $valueStatus = Http::CREATED->value;
    $data = $this->post->toArray();
    $data['title'] = $newTitle;
    $testResponse = patch(route('api:v1:posts:update', $this->post->key), $data)
        ->assertStatus($valueStatus);
    $content = json_decode($testResponse->getContent(), true);

    $this->post->refresh();
    expect($content['id'])->toBe($this->post->key);
    expect($this->post)
        ->title
        ->toBe($newTitle);
});

it('tests the ability to delete a post', function () {
    assertDatabaseHas('posts', [
        'id' => $this->post->id,
        'title' => $this->post->title
    ]);

    assertNull($this->post->deleted_at);

    delete(route('api:v1:posts:delete', $this->post->key))
        ->assertStatus(Http::ACCEPTED->value);

    $this->post->refresh();

    assertNotNull($this->post->deleted_at);
});
