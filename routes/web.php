<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;


Route::get('/', HomeController::class)->name('home');

Route::prefix('services')->group(function () {

    Route::get('/', [ServiceController::class, 'index'])
        ->name('services.index');

    Route::get('/category/{category:slug}', [ServiceController::class, 'category'])
        ->name('services.category');

    Route::get(
        '/category/{category:slug}/{subcategory:slug}',
        [ServiceController::class, 'subcategory']
    )->name('services.subcategory');

    Route::get('/item/{service:slug}', [ServiceController::class, 'show'])
        ->name('services.show');
});


Route::prefix('projects')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])
        ->name('projects.index');

    Route::get('/{project:slug}', [ProjectController::class, 'show'])
        ->name('projects.show');
});

Route::get('/page/{page:key}', [PageController::class, 'show'])
    ->name('page.show');

Route::prefix('portfolio')->group(function () {
    Route::get('/', [PortfolioController::class, 'index'])
        ->name('portfolio.index');

    Route::get('/{item:slug}', [PortfolioController::class, 'show'])
        ->name('portfolio.show');
});
