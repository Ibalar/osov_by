<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;

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

    Route::get('/category/{category:slug}', [ProjectController::class, 'category'])
        ->name('projects.category');

    Route::get('/{project:slug}', [ProjectController::class, 'show'])
        ->name('projects.show');
});

Route::get('/page/{page:key}', [PageController::class, 'show'])
    ->name('page.show');

Route::prefix('portfolio')->group(function () {
    Route::get('/', [PortfolioController::class, 'index'])
        ->name('portfolio.index');

    Route::get('/category/{category:slug}', [PortfolioController::class, 'category'])
        ->name('portfolio.category');

    Route::get('/{item:slug}', [PortfolioController::class, 'show'])
        ->name('portfolio.show');
});

Route::get('/sitemap.xml', [SitemapController::class, 'index'])
    ->name('sitemap');

Route::get('/landing/{slug}', [LandingController::class, 'show'])
    ->name('landings.show');

Route::prefix('laravel-filemanager')->group(function () {
    Lfm::routes();
});
