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
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DonasiBarangController;
use App\Http\Controllers\DonationTypeController;
use App\Http\Controllers\KeuanganLksaController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\ProfileUserController;
use App\Http\Livewire\CreateDonasiBarang;
use App\Http\Livewire\DataDonasiTransfer;
use App\Http\Livewire\DataIncomeLksa;
use App\Http\Livewire\DataOutcomeLksa;
use App\Http\Livewire\DataPengeluaran;
use App\Http\Livewire\IncomeAndExpenseReport;
use App\Http\Livewire\LaporanPemasukanPengeluaran;
use App\Http\Livewire\LksaDocument;
use App\Http\Livewire\Pengurus;

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

Route::prefix('pembina-yayasan')->middleware('pembina-yayasan')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.pembina.yayasan');
    Route::get('/data-santri-dalam', [AnakAsuhController::class, 'index'])->name('santri.dalam.pembina.yayasan');
    Route::get('/data-santri-luar', [AnakAsuhController::class, 'santriLuar'])->name('santri.luar.pembina.yayasan');
});

Route::prefix('ketua-yayasan')->middleware('ketua-yayasan')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.ketua.yayasan');
});

Route::prefix('bendahara-yayasan')->middleware('bendahara-yayasan')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.bendahara.yayasan');
});

Route::prefix('admin-donasi')->middleware('admin-donasi')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.admin.donasi');
});

Route::prefix('sekertariat-yayasan')->middleware('sekertariat-yayasan')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.sekertariat.yayasan');
});

Route::prefix('ketua-lksa')->middleware('ketua-lksa')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.ketua.lksa');
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

    Route::get('/cetak-laporan-pemasukan-pengeluaran-donasi-lksa/{date1}/{date2}', [IncomeAndExpenseReport::class, 'printPDFLaporan'])->name('cetak.laporan.pemasukan.pengeluaran.lksa');
    Route::get('/cetak-laporan-pemasukan-pengeluaran-donasi-excel-lksa/{date1}/{date2}', [IncomeAndExpenseReport::class, 'exportExcel'])->name('export.excel.laporan');

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

    // LKSA DOCUMENT
    Route::get('/dokumen-lksa', [DocumentController::class, 'lksa'])->name('lksa.document');
    Route::get('/dokumen-yayasan', [DocumentController::class, 'yayasan'])->name('yayasan.document');

    // Warga
    Route::get('/tambah-data-warga', [CitizenController::class, 'createCitizen'])->name('create.citizen');
    Route::get('/data-warga-dhuafa', [CitizenController::class, 'dataWargaDhuafa'])->name('data.warga.dhuafa');
    Route::get('/data-warga-fakir-miskin', [CitizenController::class, 'dataWargaFakirMiskin'])->name('data.warga.fakir.miskin');
    Route::get('/data-warga-jompo', [CitizenController::class, 'dataWargaJompo'])->name('data.warga.jompo');
    Route::get('/data-warga-jamaah', [CitizenController::class, 'dataWargaJamaah'])->name('data.warga.jamaah');
    Route::get('/data-warga-meninggal', [CitizenController::class, 'dataWargaMeninggal'])->name('data.warga.meninggal');
    Route::get('/data-warga-dusun', [CitizenController::class, 'dataWargaDusun'])->name('data.warga.dusun');
    Route::get('/profil-warga/{id}', [CitizenController::class, 'profileWarga'])->name('profil.warga');
    Route::get('/edit-warga/{id}', [CitizenController::class, 'editCitizen'])->name('edit.warga');

    Route::get('/data-pengguna', [UserController::class, 'dataUser'])->name('data.pengguna');

    // menu santri
    Route::get('/tambah-santri', [AnakAsuhController::class, 'create'])->name('create.santri');
    Route::get('/data-santri-dalam', [AnakAsuhController::class, 'index'])->name('santri.dalam');
    Route::get('/data-santri-luar', [AnakAsuhController::class, 'santriLuar'])->name('santri.luar');

    // Pengguna
    Route::get('/tambah-pengguna', [UserController::class, 'createUser'])->name('tambah.pengguna');
    Route::get('/data-pengguna', [UserController::class, 'dataUser'])->name('data.pengguna');
    Route::get('/ubah-pengguna/{id}', [UserController::class, 'editUser'])->name('edit.pengguna');

    // Income Lksa
    Route::get('/tambah-pemasukan-lksa', [KeuanganLksaController::class, 'pemasukan'])->name('income.lksa');
    Route::get('/data-pemasukan-lksa', [KeuanganLksaController::class, 'dataPemasukan'])->name('data.income.lksa');
    Route::get('/export-data-pemasukan-lksa-pdf', [KeuanganLksaController::class, 'exportDataPemasukan'])->name('export.data.income.lksa.pdf');

    // Outcome LKSA
    Route::get('tambah-pengeluaran-lksa', [KeuanganLksaController::class, 'pengeluaran'])->name('outcome.lksa');
    Route::get('data-pengeluaran-lksa', [KeuanganLksaController::class, 'dataPengeluaran'])->name('data.outcome.lksa');

    // income and expense report
    Route::get('data-pemasukan-pengeluaran-lksa', [KeuanganLksaController::class, 'laporan'])->name('data.income.outcome.lksa');

    // Master data pendidikan
    Route::get('master-data-pendidikan', [MasterDataController::class, 'pendidikan'])->name('master.data.pendidikan');
    Route::get('master-data-position', [MasterDataController::class, 'position'])->name('master.data.position');

    // Export Donasi Tunai PDF
    Route::get('export-donasi-tunai-pdf', [Donation::class, 'exportPdf'])->name('export.donasi.tunai.pdf');

    // Export Donasi Transfer PDF
    Route::get('export-donasi-transfer-pdf', [DataDonasiTransfer::class, 'exportPdf'])->name('export.donasi.transfer.pdf');

    // Export Donasi Barang PDF
    Route::get('export-donasi-barang-pdf', [DonationGoods::class, 'exportPdf'])->name('export.donasi.barang.pdf');

    // Export Pengeluaran Yayasan
    Route::get('export-pengeluaran-yayasan', [DataPengeluaran::class, 'exportPdf'])->name('export.pengeluaran.yayasan.pdf');

    // Export Pemasukan Yayasan
    Route::get('export-pemasukan-lksa', [DataIncomeLksa::class, 'exportPdf'])->name('export.pemasukan.lksa.pdf');

    // Export Pemasukan Yayasan
    Route::get('export-pengeluaran-lksa', [DataOutcomeLksa::class, 'exportPdf'])->name('export.pengeluaran.lksa.pdf');

    // Export Pengurus
    Route::get('export-pengurus-pdf', [Pengurus::class, 'exportPdf'])->name('export.pengurus.pdf');

    // Surat masuk keluar yayasan
    Route::get('tambah-surat-yayasan', [LetterController::class, 'createLetterYayasan'])->name('create.letter.yayasan');
    Route::get('data-surat-masuk-yayasan', [LetterController::class, 'dataIncomingLetterYayasan'])->name('data.incoming.letter.yayasan');
    Route::get('data-surat-keluar-yayasan', [LetterController::class, 'dataOutcomeLetterYayasan'])->name('data.outcome.letter.yayasan');

    // Surat masuk keluar lksa
    Route::get('tambah-surat-lksa', [LetterController::class, 'createLetterLksa'])->name('create.letter.lksa');
    Route::get('data-surat-masuk-lksa', [LetterController::class, 'dataIncomingLetterLksa'])->name('data.incoming.letter.lksa');
    Route::get('data-surat-keluar-lksa', [LetterController::class, 'dataOutcomeLetterLksa'])->name('data.outcome.letter.lksa');

    Route::get('profile-user', [ProfileUserController::class, 'index'])->name('profile.user');
});
