<?php

use App\Http\Livewire\Donation;
use App\Http\Livewire\DonasiTunai;
use App\Http\Livewire\Pengeluaran;
use Illuminate\Support\Facades\Log;
use App\Http\Livewire\DonationGoods;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\CitizenController;
use App\Http\Controllers\DonaturController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AnakAsuhController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonasiBarangController;
use App\Http\Controllers\DonationTypeController;
use App\Http\Livewire\CreateDonasiBarang;
use App\Http\Livewire\LaporanPemasukanPengeluaran;

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



Route::prefix('admin-yayasan')->middleware('admin-yayasan')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.admin.yayasan');

    // menu santri
    Route::get('/tambah-santri', [AnakAsuhController::class, 'create'])->name('create.santri.admin.yayasan');
    Route::get('/data-santri-dalam', [AnakAsuhController::class, 'index'])->name('santri.dalam.admin.yayasan');
    Route::get('/data-santri-luar', [AnakAsuhController::class, 'santriLuar'])->name('santri.luar.admin.yayasan');

    // menu kedonaturan
    Route::get('/donatur', [DonaturController::class, 'index'])->name('donatur.admin.yayasan');

    // donasi tunai
    Route::get('/donasi-tunai', [DonationController::class, 'donasiTunai'])->name('donasi.tunai.admin.yayasan');
    Route::get('/data-donasi-tunai', [DonationController::class, 'index'])->name('donation.tunai.admin.yayasan');

    // donasi transfer
    Route::get('/donasi-transfer', [DonationController::class, 'donasiTransfer'])->name('donasi.transfer.admin.yayasan');
    Route::get('/data-donasi-transfer', [DonationController::class, 'dataDonasiTransfer'])->name('data.donasi.transfer.admin.yayasan');

    // donasi barang
    Route::get('/donasi-barang', [DonationController::class, 'donationGoods'])->name('donation.goods.admin.yayasan');
    Route::get('tambah-donasi-barang', [DonasiBarangController::class, 'create'])->name('create.donasi.barang.admin.yayasan');
    Route::post('tambah-donasi-barang', [DonasiBarangController::class, 'store'])->name('store.donasi.barang.admin.yayasan');

    // Pengguna
    Route::get('/tambah-pengguna', [UserController::class, 'createUser'])->name('tambah.pengguna.admin.yayasan');
    Route::get('/data-pengguna', [UserController::class, 'dataUser'])->name('data.pengguna.admin.yayasan');
    Route::get('/ubah-pengguna/{id}', [UserController::class, 'editUser'])->name('edit.pengguna.admin.yayasan');

    // Warga
    Route::get('/tambah-data-warga', [CitizenController::class, 'createCitizen'])->name('create.citizen');
    Route::get('/data-warga-dhuafa', [CitizenController::class, 'dataWargaDhuafa'])->name('data.warga.dhuafa');
    Route::get('/data-warga-fakir-miskin', [CitizenController::class, 'dataWargaFakirMiskin'])->name('data.warga.fakir.miskin');
    Route::get('/data-warga-jompo', [CitizenController::class, 'dataWargaJompo'])->name('data.warga.jompo');
    Route::get('/data-warga-jamaah', [CitizenController::class, 'dataWargaJamaah'])->name('data.warga.jamaah');
    Route::get('/data-warga-meninggal', [CitizenController::class, 'dataWargaMeninggal'])->name('data.warga.meninggal');
    Route::get('/profil-warga/{id}', [CitizenController::class, 'profileWarga'])->name('profil.warga');
    Route::get('/edit-warga/{id}', [CitizenController::class, 'editCitizen'])->name('edit.warga');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/donatur', [DonaturController::class, 'index'])->name('donatur');

    Route::get('/tipe-donasi', [DonationTypeController::class, 'index'])->name('donation.type');

    Route::get('/data-donasi-tunai', [DonationController::class, 'index'])->name('donation.tunai');

    Route::get('/donasi-barang', [DonationController::class, 'donationGoods'])->name('donation.goods');
    Route::get('/bukti-donasi/{id}', [DonationController::class, 'proofOfDonation'])->name('proof.of.donation');
    Route::get('/send-tanda-terima-barang/{data}', [DonationGoods::class, 'saveInvoice']);
    Route::get('/update-tanda-terima-barang/{data}', [DonationGoods::class, 'updateInvoice']);


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
    Route::get('/data-donasi-transfer', [DonationController::class, 'dataDonasiTransfer'])->name('data.donasi.transfer');


    Route::get('/pengeluaran', [DonationController::class, 'pengeluaran'])->name('pengeluaran');
    Route::get('/data-pengeluaran', [DonationController::class, 'dataPengeluaran'])->name('data.pengeluaran');

    Route::get('/laporan-pemasukan-pengeluaran', [DonationController::class, 'laporan'])->name('laporan.pemasukan.pengeluaran');
    // Route::get('/cetak-laporan-pemasukan-pengeluaran-donasi', [Pengeluaran::class, 'print'])->name('cetak.laporan.pemasukan.pengeluaran.donasi');

    Route::get('/cetak-laporan-pemasukan-pengeluaran-donasi/{date1}/{date2}', [LaporanPemasukanPengeluaran::class, 'printPDFLaporan'])->name('cetak.laporan.pemasukan.pengeluaran.donasi');
    Route::get('/cetak-laporan-pemasukan-pengeluaran-donasi-excel/{date1}/{date2}', [LaporanPemasukanPengeluaran::class, 'exportExcel'])->name('export.excel.laporan');
    Route::get('/send-tanda-terima-tunai/{data}', [DonasiTunai::class, 'sendWa']);
    Route::get('/update-tanda-terima-tunai/{data}', [Donation::class, 'updateSendWa']);

    Route::get('tambah-donasi-barang', [DonasiBarangController::class, 'create'])->name('create.donasi.barang');
    Route::post('tambah-donasi-barang', [DonasiBarangController::class, 'store'])->name('store.donasi.barang');


    Route::group(['prefix' => 'pengaturan'], function () {
        Route::get('/satuan', [SettingController::class, 'unit'])->name('satuan');
    });

    Route::get('/export-santri/{tipe}', [AnakAsuhController::class, 'exportSantriPdf'])->name('export.santri');
    Route::get('/export-donatur', [DonaturController::class, 'exportDonaturPdf'])->name('export.donatur');
    Route::get('/export-warga/{status}', [CitizenController::class, 'exportWargaPdf'])->name('export.warga');

    Route::get('/data-donasi-tunai', [DonationController::class, 'index'])->name('donation.tunai');

    Route::get('/print-invoice-donation/{id}', [Donation::class, 'printInvoiceDonation'])->name('print.invoice.donation');
    Route::get('/print-invoice-donation-goods/{id}', [CreateDonasiBarang::class, 'printInvoiceDonation'])->name('print.invoice.donation.goods');

    Route::get('/donasi-barang', [DonationController::class, 'donationGoods'])->name('donation.goods');
});
