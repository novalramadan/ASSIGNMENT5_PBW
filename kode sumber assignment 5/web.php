<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CollectionsController;
use App\Http\Controllers\UserController;
use App\Model\User;

// NOVAL ABDURRAMADAN 6706223103

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

   
    Route::get('/user', [UserController::class, 'index'])->name('user.daftarPengguna');
    Route::get('/userRegistration', [UserController::class, 'create'])->name('user.registrasi');
    Route::post('/userStore', [UserController::class, 'store'])->name('user.daftarPengguna');
    Route::get('/userView/{user}', [UserController::class, 'show'])->name('user.infoPengguna');
    Route::post('/userUpdate', [UserController::class, 'update'])->name('user.update');

    
    Route::get('/koleksi', [CollectionsController::class, 'index'])->name('koleksi.daftarKoleksi');
    Route::get('/koleksiTambah', [CollectionsController::class, 'create'])->name('koleksi.registrasi');
    Route::post('/koleksiStore', [CollectionsController::class, 'store'])->name('koleksi.daftarKoleksi');
    Route::get('/koleksiView/{collection}', [CollectionsController::class, 'show'])->name('koleksi.infoKoleksi');
    Route::post('/koleksiUpdate', [CollectionsController::class, 'update'])->name('koleksi.update');
});

require __DIR__.'/auth.php';

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
