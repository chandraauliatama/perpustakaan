<?php

use App\Http\Controllers\Auth\RedirectAuthenticatedUsersController;
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

Route::get('/', function () {
    return view('welcome');
})->middleware(['guest']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/redirectAuthenticatedUsers', [RedirectAuthenticatedUsersController::class, "home"]);

    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function(){
        Route::get('tes', function() {
            return 'halo ini halaman khusus admin';
        });
    });

    Route::group(['middleware' => 'role:pimpinan', 'prefix' => 'pimpinan', 'as' => 'pimpinan.'], function(){
        Route::get('tes', function() {
            return 'halo ini halaman khusus pimpinan';
        });
    });

    Route::group(['middleware' => 'role:operator', 'prefix' => 'operator', 'as' => 'operator.'], function(){
        Route::get('tes', function() {
            return 'halo ini halaman khusus operator';
        });
    });

    Route::group(['middleware' => 'role:anggota', 'prefix' => 'anggota', 'as' => 'anggota.'], function(){
        Route::get('tes', function() {
            return 'halo ini halaman khusus anggota';
        });
    });
});

require __DIR__.'/auth.php';
