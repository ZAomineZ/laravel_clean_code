<?php

use App\Http\Controllers\Web\Posts\StoreController;
use Domain\Blogging\Reports\PostsCreatedOverPeriod;
use Illuminate\Support\Facades\Route;
use Spatie\Period\Period;

Route::view('/', 'welcome')->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/test', function () {
    $report = new PostsCreatedOverPeriod(
        Period::make("2023-02-22 13:29:46", "2023-02-22 17:18:08")
    );

    dd($report->totalPosts());
});

/**
 * Post Routes
 */
Route::prefix('posts')->as('posts:')->group(function () {
    Route::post('/', StoreController::class)->name('store');
});
