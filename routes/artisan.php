<?php

use App\Http\Controllers\Artisans\ArtisanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    dd('Welcome to artisan route file.');
});
/*
|--------------------------------------------------------------------------
| Artisan Command Web Routes
|--------------------------------------------------------------------------
*/
Route::get('/storage-link', [ArtisanController::class, 'storageLink']);
Route::get('/optimize', [ArtisanController::class, 'optimize']);
Route::get('/optimize-clear', [ArtisanController::class, 'optimizeClear']);
Route::get('/db-create', [ArtisanController::class, 'dbCreate']);
Route::get('/migrate', [ArtisanController::class, 'migrate']);
Route::get('/migrate-fresh', [ArtisanController::class, 'migrateFresh']);
Route::get('/migrate-fresh-seed', [ArtisanController::class, 'migrateFreshSeed']);
Route::get('/migrate-refresh', [ArtisanController::class, 'migrateRefresh']);
Route::get('/migrate-refresh-seed', [ArtisanController::class, 'migrateRefreshSeeder']);
Route::get('/seed', [ArtisanController::class, 'dbSeed']);