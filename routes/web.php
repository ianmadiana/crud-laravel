<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\MstJabatanController;
use App\Http\Controllers\MstPangkatController;
use App\Http\Controllers\RiwayatPangkatController;


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

Route::get('/', function () {
    return view('welcome');
});

//try php artisan route:clear if controller doesn't exist
Route::resource('/mst-pangkat', MstPangkatController::class);
Route::resource('/mst-jabatan', MstJabatanController::class);
Route::resource('/pegawai', PegawaiController::class);


Auth::routes();

Route::resource('/home', HomeController::class);

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Auth::routes();

//riwayat pangkat modul 7
Route::get('/riwayat-pangkat', [RiwayatPangkatController::class, 'index']);

//create
Route::get('/riwayat-pangkat/create/{id}', [RiwayatPangkatController::class, 'create']);

//show pegawai
Route::get(
    '/riwayat-pangkat/proses/{id}',
    [RiwayatPangkatController::class, 'proses']
)->name('index');

//Menambahkan Kenaikan Pangkat
Route::get(
    '/riwayat-pangkat/proses/{id}',
    [RiwayatPangkatController::class, 'proses']
)->name('index1');

//cetak
Route::get('/riwayat-pangkat/cetak/{id}', [RiwayatPangkatController::class, 'cetak']);

//store
// Route::get('/riwayat-pangkat/store', [RiwayatPangkatController::class, 'store']);
// Route::post('/riwayat-pangkat/store','RiwayatPangkatController@store')
// ->name('riwayat-pangkat.store');
Route::post(
    '/riwayat-pangkat/store',
    [RiwayatPangkatController::class, 'store']
)->name('riwayat-pangkat.store');

//show
// Route::get('/riwayat-pangkat/show/{id}','RiwayatPangkatController@show')
// ->name('riwayat-pangkat.show');
Route::get(
    '/riwayat-pangkat/show/{id}',
    [RiwayatPangkatController::class, 'show']
)->name('riwayat-pangkat.show');

//edit
// Route::get('/riwayat-pangkat/{id}/edit','RiwayatPangkatController@edit')
// ->name('riwayat-pangkat.edit');
Route::get(
    '/riwayat-pangkat/{id}/edit',
    [RiwayatPangkatController::class, 'edit']
)->name('riwayat-pangkat.edit');

//update
// Route::patch('/riwayat-pangkat/update/{id}','RiwayatPangkatController@update')
// ->name('riwayat-pangkat.update');
Route::patch(
    '/riwayat-pangkat/update/{id}',
    [RiwayatPangkatController::class, 'update']
)->name('riwayat-pangkat.update');



//destroy
// Route::delete('/riwayat-pangkat/destroy/{id}', [RiwayatPangkatController::class, 'destroy']);
// Route::delete('/riwayat-pangkat/destroy/{id}','RiwayatPangkatController@destroy')
// ->name('destroy');
Route::delete(
    '/riwayat-pangkat/destroy/{id}',
    [RiwayatPangkatController::class, 'destroy']
)->name('riwayat-pangkat.destroy');






