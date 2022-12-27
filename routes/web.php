<?php

use App\Http\Controllers\AnakAsuhController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DonationTypeController;
use App\Http\Controllers\DonaturController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\SettingController;
use App\Http\Livewire\DonasiTunai;
use App\Http\Livewire\Donation;
use App\Http\Livewire\LaporanPemasukanPengeluaran;
use App\Http\Livewire\Pengeluaran;
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

    Route::get('/data-donasi-tunai', [DonationController::class, 'index'])->name('donation.tunai');

    Route::get('/donasi-barang', [DonationController::class, 'donationGoods'])->name('donation.goods');
    Route::get('/bukti-donasi/{id}', [DonationController::class, 'proofOfDonation'])->name('proof.of.donation');
    Route::get('/cetak-donasi', [Donation::class, 'print'])->name('cetak.donasi');
    Route::get('/laporan-penggunaan-dana', [DonationController::class, 'reportFunds'])->name('laporan.penggunaan.dana');
    Route::get('/anak-asuh', [AnakAsuhController::class, 'index'])->name('anak.asuh');
    Route::get('/profile-anak-asuh/{id}', [AnakAsuhController::class, 'profileAnak'])->name('profile.anak.asuh');
    Route::get('/tambah-anak-asuh', [AnakAsuhController::class, 'create'])->name('tambah.anak.asuh');
    Route::get('/edit-data-anak-asuh/{id}', [AnakAsuhController::class, 'show'])->name('edit.data.anak.asuh');
    Route::get('/berkas-anak-asuh/{id}', [AnakAsuhController::class, 'childDocument'])->name('berkas.anak.asuh');
    Route::get('/tabungan-anak-asuh', [SavingController::class, 'index'])->name('tabungan.anak.asuh');
    Route::get('/detail-tabungan-anak-asuh/{id}', [SavingController::class, 'show'])->name('detail.tabungan.anak.asuh');
    Route::get('/cetak-tabungan-anak-asuh/{id}', [SavingController::class, 'print'])->name('cetak.tabungan.anak.asuh');

    Route::get('/pengurus', [PengurusController::class, 'index'])->name('pengurus');
    Route::get('/tambah-pengurus', [PengurusController::class, 'create'])->name('tambah.pengurus');
    Route::get('/profile-pengurus/{id}', [PengurusController::class, 'show'])->name('profile.pengurus');
    Route::get('/edit-pengurus/{id}', [PengurusController::class, 'edit'])->name('edit.pengurus');

    // Route::get('/pilih-jenis-donasi', [DonationController::class, 'pilih'])->name('pilih.jenis.donasi');
    Route::get('/donasi-tunai', [DonationController::class, 'donasiTunai'])->name('donasi.tunai');
    Route::get('/donasi-transfer', [DonationController::class, 'donasiTransfer'])->name('donasi.transfer');

    Route::get('/pengeluaran', [DonationController::class, 'pengeluaran'])->name('pengeluaran');

    Route::get('/laporan-pemasukan-pengeluaran', [DonationController::class, 'laporan'])->name('laporan.pemasukan.pengeluaran');
    // Route::get('/cetak-laporan-pemasukan-pengeluaran-donasi', [Pengeluaran::class, 'print'])->name('cetak.laporan.pemasukan.pengeluaran.donasi');

    Route::get('/cetak-laporan-pemasukan-pengeluaran-donasi/{date1}/{date2}', [LaporanPemasukanPengeluaran::class, 'printPDFLaporan'])->name('cetak.laporan.pemasukan.pengeluaran.donasi');
    Route::get('/cetak-laporan-pemasukan-pengeluaran-donasi-excel/{date1}/{date2}', [LaporanPemasukanPengeluaran::class, 'exportExcel'])->name('export.excel.laporan');


    Route::group(['prefix' => 'pengaturan'], function () {
        Route::get('/satuan', [SettingController::class, 'unit'])->name('satuan');
    });
});

Route::get('/send/{data}', [DonasiTunai::class, 'sendWa']);
