<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::controller(BannerController::class)->group(function () {
        Route::get('/banners', 'index')->name('banners.index');
        Route::get('/banners/{banner}/edit', 'edit')->name('banners.edit');
        Route::put('/banners/{banner}', 'update')->name('banners.update');
        Route::post('/banners', 'store')->name('banners.store');
        Route::get('/banners/deactivate/{banner}', 'deactivate')->name('banners.deactivate');
        Route::get('/banners/activate/{banner}', 'activate')->name('banners.activate');
        Route::put('banners-add-image/{banner}', 'add_image')->name('banners.add.image');
        Route::put('banners-delete-image/{banner}', 'delete_image')->name('banners.delete.image');
        Route::delete('banners/{banner}', 'destroy')->name('banners.destroy');
    });

    // Auth Controller
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
