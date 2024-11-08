<?php


use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PengaduanUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('pages.dasboard.index');
});

Route::get('/login', [HomeController::class,'login'])->name('login');

//Route untuk register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);


// Route untuk halaman login
// Route::get('/login', function () {
//     return view('pages.auth.auth-login')->name('login');
// });


// Rute yang hanya bisa diakses oleh pengguna yang terautentikasi

Route::middleware(['auth'])->group(function () {

    // Dashboard route
    Route::get('home', [DashboardController::class, 'index'])->name('home');

    // Route manajemen user, hanya bisa diakses oleh admin
    Route::middleware(['role:admin|anggota'])->group(function () {
        Route::resource('user', UserController::class);
    });

    // Route manajemen pengaduan, bisa diakses oleh admin dan anggota
    Route::middleware(['role:anggota|admin'])->group(function () {
        Route::resource('pengaduan', PengaduanController::class);
        Route::post('/pengaduan/{id}/update-status', [PengaduanController::class, 'updateStatus'])->name('pengaduan.updateStatus');

     });


     Route::middleware(['auth', 'role:user'])->group(function () {
        Route::get('/pengaduanuser', [PengaduanUserController::class, 'index'])->name('pengaduanuser.index');
        Route::get('/pengaduanuser/create', [PengaduanUserController::class, 'create'])->name('pengaduanuser.create');
        Route::post('/pengaduanuser/store', [PengaduanUserController::class, 'store'])->name('pengaduanuser.store');
        Route::get('/pengaduanuser/{id}', [PengaduanUserController::class, 'show'])->name('pengaduanuser.show');
      });


      Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/category', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/category/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/category/store', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/category/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit'); // Rute untuk menampilkan form edit
        Route::put('/category/{category}', [CategoryController::class, 'update'])->name('categories.update'); // Rute untuk memproses pembaruan kategori
        Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy'); // Rute untuk menghapus kategori
    });



    });
