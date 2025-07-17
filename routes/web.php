<?php

namespace App;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardRentController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardRoomController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TemporaryRentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CalendarController;

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
    return view('index', [
        'title' => "Home",
    ]);
});

Route::get('/test', function () {
    return view('test', [
        'title' => "Test",
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('dashboard/rents/{id}/endTransaction', [DashboardRentController::class, 'endTransaction'])->middleware('auth');

Route::resource('dashboard/rents', DashboardRentController::class)->middleware('auth');

Route::resource('dashboard/rooms', DashboardRoomController::class)->middleware('auth');
Route::get('dashboard/rooms/{id}/edit', [DashboardRoomController::class, 'edit'])->name('dashboard.rooms.edit')->middleware('auth');
Route::put('dashboard/rooms/{id}/update', [DashboardRoomController::class, 'update'])->name('dashboard.rooms.update')->middleware('auth');


Route::get('dashboard/users/{id}/makeAdmin', [DashboardUserController::class, 'makeAdmin'])->middleware('auth');
Route::resource('dashboard/users', DashboardUserController::class)->middleware('auth');

Route::put('dashboard/users/{user}', [DashboardUserController::class, 'update'])
->name('dashboard.users.update')
->middleware('auth');



Route::resource('dashboard/admin', DashboardAdminController::class)->middleware('auth');
Route::get('dashboard/admin/{id}/removeAdmin', [DashboardAdminController::class, 'removeAdmin'])->middleware('auth');

Route::get('dashboard/admin', [DashboardAdminController::class, 'index'])->name('dashboard.admin')->middleware('auth');
Route::get('dashboard/admin/{id}/edit', [DashboardAdminController::class, 'edit'])->name('dashboard.admin.edit')->middleware('auth');
Route::put('dashboard/admin/{id}/update', [DashboardAdminController::class, 'update'])->name('dashboard.admin.update')->middleware('auth');

Route::get('/dashboard/temporaryRents', [TemporaryRentController::class, 'index'])->middleware('auth');

Route::get('/dashboard/temporaryRents/{id}/acceptRents', [TemporaryRentController::class, 'acceptRents'])->middleware('auth');

Route::get('/dashboard/temporaryRents/{id}/declineRents', [TemporaryRentController::class, 'declineRents'])->middleware('auth');

Route::get('/dashboard/beranda', [DashboardController::class, 'index']);
Route::get('/dashboard/beranda/events', [DashboardController::class, 'getEvents'])->name('dashboard.beranda.events');
// Route::resource('dashboard/dash', DashboardController::class)->middleware('auth');

Route::put('/dashboard/rents/{id}/approve', [DashboardRentController::class, 'approve'])->name('rents.approve');
Route::post('/dashboard/rents/{id}/reject', [DashboardRentController::class, 'reject'])->name('rents.reject');

Route::get('events/list', [CalendarController::class, 'listEvent'])->name('events.list');
Route::resource('/dashboard/calendar', CalendarController::class);


Route::get('/help', function () {
    return view('help', [
        'title' => "Help",
    ]);
});

Route::get('/about', function () {
    return view('about', [
        'title' => "About"
    ]);
});

use App\Http\Controllers\UserController;
use App\Http\Controllers\PdfExportController;

Route::get('user', [UserController::class, 'index']);
Route::get('generatepdf', [UserController::class, 'generatepdf'])->name('user.pdf');

//upload atau import
Route::post('user-import', [UserController::class, 'import'])->name('user.import');
//export excel
Route::get('user-export', [UserController::class, 'export'])->name('user.export');

Route::get('/export-pdf', [PdfExportController::class, 'exportPdf'])->name('export.pdf');