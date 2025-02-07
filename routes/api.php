<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', \App\Http\Controllers\Auth\LoginController::class)->name('login');

Route::prefix('/articles')->group(function () {
    Route::get('/', \App\Http\Controllers\Article\IndexController::class)->name('articles.index');
    Route::get('/{article}', \App\Http\Controllers\Article\ShowController::class)->name('articles.show');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', \App\Http\Controllers\Article\StoreController::class)->name('articles.store');
//        Route::put('/{article}', \App\Http\Controllers\Article\UpdateController::class)->name('articles.update');
        Route::delete('/{article}', \App\Http\Controllers\Article\DestroyController::class)->name('articles.destroy');
    });
});

Route::prefix('/tags')->group(function () {
    Route::get('/', \App\Http\Controllers\Tag\IndexController::class)->name('tags.index');
    Route::get('/{tag}', \App\Http\Controllers\Tag\ShowController::class)->name('tags.show');

    Route::middleware('auth:sanctum')->group(function () {
//        Route::post('/', \App\Http\Controllers\Tag\StoreController::class)->name('tags.store');
//        Route::put('/{tag}', \App\Http\Controllers\Tag\UpdateController::class)->name('tags.update');
//        Route::delete('/{tag}', \App\Http\Controllers\Tag\DestroyController::class)->name('tags.destroy');
    });
});
