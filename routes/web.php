<?php

use App\Http\Controllers\LinkController;
use App\Http\Controllers\OtherController;
use App\Http\Controllers\TopController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/top');
});

// トップページ表示
Route::get('/top', [TopController::class, 'index'])->name('top');
// トップページPOSTリクエスト
Route::post('/top', [TopController::class, 'update'])->name('top.update');
// 他ページ表示
Route::get('/other', [OtherController::class, 'index'])->name('other');
// リンクページ表示
Route::get('/link', [LinkController::class, 'index'])->name('link');
