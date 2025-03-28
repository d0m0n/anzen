<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// カタログの一覧（トップページ）
Route::get('/', [CatalogController::class, 'index'])->name('catalogs.index');

// ゲストもアクセス可能なカタログの一覧と詳細
Route::get('/catalogs', [CatalogController::class, 'index'])->name('catalogs.index');
Route::get('/catalogs/{catalog}', [CatalogController::class, 'show'])->name('catalogs.show');

// ダッシュボードへのアクセス（認証済みのユーザーのみ）
Route::get('/dashboard', [CatalogController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

// 認証が必要なルートのグループ化
Route::middleware('auth')->group(function () {
    // カタログの作成画面
    Route::get('/catalogs/create', [CatalogController::class, 'create'])->name('catalogs.create');
    Route::post('/catalogs', [CatalogController::class, 'store'])->name('catalogs.store');

    // プロフィール管理
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 他のカタログ関連リソース
    Route::resource('catalogs', CatalogController::class)->except(['index', 'show', 'create', 'store']);
});

Route::resource('catalogs', CatalogController::class);

require __DIR__ . '/auth.php';
