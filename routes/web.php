<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MstJabatanController;
use App\Http\Controllers\MstPangkatController;


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

Auth::routes();

Route::resource('/home', HomeController::class);

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Auth::routes();

