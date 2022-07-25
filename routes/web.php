<?php

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () { return view('welcome');  });
});

Route::get('/showQr/{id}', [App\Http\Controllers\ShowQrController::class, 'show']);


Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', function () { return view('admin.index');  });
    Route::get('/reservation/new', function () { return view('admin.reservation.new');  });
    Route::post('/reservation/new', [App\Http\Controllers\Admin\ReservationController::class, 'new']);
    Route::get('/reservation/list', function () { return view('admin.reservation.list');  });
    Route::post('/reservation/list', [App\Http\Controllers\Admin\ReservationController::class, 'list']);
    Route::post('/reservation/showQr', [App\Http\Controllers\Admin\ReservationController::class, 'showQr']);
    Route::post('/reservation/get', [App\Http\Controllers\Admin\ReservationController::class, 'get']);
    Route::post('/reservation/edit', [App\Http\Controllers\Admin\ReservationController::class, 'edit']);
    Route::get('/users', [App\Http\Controllers\Admin\UsersController::class, 'index']);
    Route::post('/user/get', [App\Http\Controllers\Admin\UsersController::class, 'get']);
    Route::get('/settings', function () { return view('admin.settings');  });


});

require __DIR__.'/auth.php';
