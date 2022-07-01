<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Anggota;
use App\Http\Controllers\Auth\RedirectAuthenticatedUsersController;
use App\Http\Controllers\Operator;
use App\Http\Controllers\Pimpinan;
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

Route::group(['middleware' => 'auth'], function () {
    Route::get('redirectAuthenticatedUsers', RedirectAuthenticatedUsersController::class)->name('home');

    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('dashboard', Admin\DashboardController::class)->name('dashboard');
        Route::resource('user', Admin\ManageUserController::class);
        Route::get('printAllUsers', [Admin\ManageUserController::class, 'printAllUsers'])->name('printAllUsers');
    });

    Route::group(['middleware' => 'role:pimpinan', 'prefix' => 'pimpinan', 'as' => 'pimpinan.'], function () {
        Route::get('dashboard', Pimpinan\DashboardController::class)->name('dashboard');
        Route::controller(Pimpinan\PimpinanController::class)->group(function () {
            Route::get('books', 'getAllBooks')->name('books');
            Route::get('printAllBooks', 'printAllBooks')->name('printAllBooks');
            Route::get('borrowedBooks', 'getBorrowedBooks')->name('borrowedBooks');
            Route::get('lendingRules', 'lendingRules')->name('lendingRules');
            ROute::post('storeLendingRules', 'storeLendingRules')->name('storeLendingRules');
        });
    });

    Route::group(['middleware' => 'role:operator', 'prefix' => 'operator', 'as' => 'operator.'], function () {
        Route::get('dashboard', Operator\DashboardController::class)->name('dashboard');
        Route::resource('book', Operator\ManageBookController::class);
        Route::resource('borrowed', Operator\ManageBorrowedBookController::class);
        Route::get('printAllBooks', [Operator\ManageBookController::class, 'printAllBooks'])->name('printAllBooks');
    });

    Route::group(['middleware' => 'role:anggota', 'prefix' => 'anggota', 'as' => 'anggota.'], function () {
        Route::get('dashboard', Anggota\DashboardController::class)->name('dashboard');
        Route::get('booklist', Anggota\BookListController::class)->name('booklist');
        Route::get('borrowedList', Anggota\BorrowedListController::class)->name('borrowedList');
        Route::post('borrow/{book}', Anggota\BorrowBookController::class)->name('borrow');
    });
});

require __DIR__.'/auth.php';
