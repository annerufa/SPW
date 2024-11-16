<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\C_User;
use App\Http\Controllers\C_Auth;
use App\Http\Controllers\C_Customer;
use App\Http\Controllers\C_Pembayaran;
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
    return view('login');
});
// login & logout
Route::get('login', [C_Auth::class, 'login'])->name('login');
Route::post('actionlogin', [C_Auth::class, 'actionlogin'])->name('actionlogin');
Route::get('logout', [C_Auth::class, 'actionlogout'])->name('logout');
//homegage
Route::get('/owner', [C_Auth::class, 'owner'])->middleware('checkRoles:owner');
Route::get('/pegawai', [C_Auth::class, 'pegawai'])->middleware('checkRoles:pegawai');

// kelola data user
Route::resource('user', C_User::class)->middleware('checkRoles:owner');
Route::get('/users/delete/{id}', [C_User::class, 'hapus'])->middleware('checkRoles:owner');

//kelola data customer
Route::resource('customer', C_Customer::class);
Route::get('/customer/del/{id}', [C_Customer::class, 'hapus'])->middleware('checkRoles:pegawai');
//cetak kartu cust
Route::get('/createQr/{id}', [C_Customer::class, 'createQr']);
// Route::post('/user/{id}', '@hapus');

//kelola data customer
Route::resource('pembayaran', C_Pembayaran::class);


// rekap dan laporan
Route::get('/rekapCust', [C_Customer::class, 'showRekap']);
Route::get('/cetakRekapCust', [C_Customer::class, 'cetakRekapCust']);
Route::get('/findRekap/{bulanRekap}', [C_Customer::class, 'findRekap']);

Route::get('/tagihanQr/{id}', [C_Pembayaran::class, 'showTagihan']);
Route::get('/kwitansi/{idBayar}', [C_Pembayaran::class, 'cetakKwitansi']);

Route::get('/rekapBayar', [C_Pembayaran::class, 'showRekap']);
Route::get('/cetakRekapBayar/{bulanRekap}', [C_Pembayaran::class, 'cetakRekapBayar']);
Route::get('/findRekapBayar/{bulanRekap}', [C_Pembayaran::class, 'findRekap']);
//
// Route::get('/', [C_Customer::class, 'rekap']);


Route::get('/cek', [C_Customer::class, 'cek']);
// Route::get('/', function () { return view('login'); });



Route::get('/scan', function () { return view('pegawai.scanQr'); });