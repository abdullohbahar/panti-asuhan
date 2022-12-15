<?php

use App\Http\Controllers\AnakAsuhController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DonationTypeController;
use App\Http\Controllers\DonaturController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\SettingController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [AuthController::class, 'index'])->middleware('guest');



Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/donatur', [DonaturController::class, 'index'])->name('donatur');
    Route::get('/tipe-donasi', [DonationTypeController::class, 'index'])->name('donation.type');
    Route::get('/donasi-uang', [DonationController::class, 'index'])->name('donation');
    Route::get('/donasi-barang', [DonationController::class, 'donationGoods'])->name('donation.goods');
    Route::get('/bukti-donasi/{id}', [DonationController::class, 'proofOfDonation'])->name('proof.of.donation');
    Route::get('/anak-asuh', [AnakAsuhController::class, 'index'])->name('anak.asuh');
    Route::get('/tambah-anak-asuh', [AnakAsuhController::class, 'create'])->name('tambah.anak.asuh');
    Route::get('/edit-data-anak-asuh/{id}', [AnakAsuhController::class, 'show'])->name('edit.data.anak.asuh');
    Route::get('/tabungan-anak-asuh', [SavingController::class, 'index'])->name('tabungan.anak.asuh');
    Route::get('/detail-tabungan-anak-asuh/{id}', [SavingController::class, 'show'])->name('detail.tabungan.anak.asuh');
    Route::get('/cetak-tabungan-anak-asuh/{id}', [SavingController::class, 'print'])->name('cetak.tabungan.anak.asuh');

    Route::group(['prefix' => 'pengaturan'], function () {
        Route::get('/satuan', [SettingController::class, 'unit'])->name('satuan');
    });
});
