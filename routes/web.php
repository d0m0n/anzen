<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

// カタログの一覧（トップページ）
Route::get('/', [CatalogController::class, 'index'])->name('catalogs.index');

// ゲストもアクセス可能なカタログの一覧と詳細
Route::get('/catalogs', [CatalogController::class, 'index'])->name('catalogs.index');
Route::get('/catalogs/{catalog}', [CatalogController::class, 'show'])->name('catalogs.show');
Route::get('/catalogs/provider/{provider_id}', [CatalogController::class, 'filterByProvider'])->name('catalogs.provider');
Route::get('/catalogs/provider/{provider_id}/list', [CatalogController::class, 'providerCatalogs'])->name('catalogs.provider.list');

// ダッシュボードへのアクセス（認証済みのユーザーのみ）
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// 認証が必要なルートのグループ化
Route::middleware('auth')->group(function () {
    // カタログの作成画面
    Route::get('/catalogs/create', [CatalogController::class, 'create'])->name('catalogs.create');
    Route::post('/catalogs', [CatalogController::class, 'store'])->name('catalogs.store');

    // プロフィール管理
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/details', [ProfileController::class, 'updateDetails'])->name('profile.update.details');
    Route::patch('/profile/update-details', [ProfileController::class, 'updateDetails'])->name('profile.update.details');

    // 他のカタログ関連リソース
    Route::resource('catalogs', CatalogController::class)->except(['index', 'show']);
    Route::get('/catalogs/{catalog}/edit', [CatalogController::class, 'edit'])->name('catalogs.edit');
    Route::put('/catalogs/{catalog}', [CatalogController::class, 'update'])->name('catalogs.update');
    Route::delete('/catalogs/{provider_id}', [CatalogController::class, 'destroy'])->name('catalogs.destroy');
});

// 不要なテストルートを削除
// Route::get('/test-create', function () {
//     return view('catalogs.create');
// });

require __DIR__ . '/auth.php';
