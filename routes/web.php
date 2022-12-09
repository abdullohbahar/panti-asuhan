<?php

use App\Http\Controllers\AnakAsuhController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DonationTypeController;
use App\Http\Controllers\DonaturController;
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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/donatur', [DonaturController::class, 'index'])->name('donatur');
    Route::get('/tipe-donasi', [DonationTypeController::class, 'index'])->name('donation.type');
    Route::get('/donasi', [DonationController::class, 'index'])->name('donation');
    Route::get('/bukti-donasi/{id}', [DonationController::class, 'proofOfDonation'])->name('proof.of.donation');
    Route::get('/anak-asuh', [AnakAsuhController::class, 'index'])->name('anak.asuh');
    Route::get('/tambah-anak-asuh', [AnakAsuhController::class, 'create'])->name('tambah.anak.asuh');
});
