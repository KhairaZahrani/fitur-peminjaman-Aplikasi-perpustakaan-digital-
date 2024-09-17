    <?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UlasanController;
use Illuminate\Support\Facades\Route;

    Route::get('/', function () {
        return view('welcome');
    });

Route::resource('buku', BukuController::class)->middleware('Login');
Route::resource('kategori', KategoriController::class);
Route::resource('ulasan', UlasanController::class);
Route::resource('peminjaman', PeminjamanController::class);
Route::get('/laporan', [LaporanController::class, 'cetak']);


route::get('/login', [SessionController::class, 'index']);
route::post('/login', [SessionController::class, 'login']);
route::get('/register', [SessionController::class, 'register']);
route::post('/register/create', [SessionController::class, 'create']);

route::get('/sesi/logout', [SessionController::class, 'logout']);

route::get('/', [DashboardController::class, 'index'])->middleware('Login');


Route::fallback(function () {
    return response()->make('
        <p>Maaf, halaman yang Anda cari tidak ditemukan.</p>
        <a href="/">Kembali ke Dashboard</a>');
});
