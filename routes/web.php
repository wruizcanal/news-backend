<?php

use App\Http\Controllers\Backend\ClientAdminController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RoleAdminController;
use App\Http\Controllers\Backend\UserAdminController;

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
    return view('welcome');
})->name('home');

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'admin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('roles', RoleAdminController::class);
    Route::resource('users', UserAdminController::class);

});

Route::get('/test', function () {

    Storage::disk('google')->put('test.txt', 'Hello World');
    //Storage::cloud()->put('test.txt', 'Hello World');
    return 'File was saved to Google Drive';
})->name('test');
