<?php

use App\Enums\MultimediaTypeEnum;
use App\Http\Controllers\Backend\AuthorAdminController;
use App\Http\Controllers\Backend\CategoryAdminController;
use App\Http\Controllers\Backend\CommentAdminController;
use App\Http\Controllers\Backend\DashboardAdminController;
use App\Http\Controllers\Backend\GalleryAdminController;
use App\Http\Controllers\Backend\MultimediaAdminController;
use App\Http\Controllers\Backend\NewsAdminController;
use App\Http\Controllers\Backend\RoleAdminController;
use App\Http\Controllers\Backend\UserAdminController;
use App\Models\Multimedia;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


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
    return view('frontend.home.welcome');
})->name('home');

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'admin'], function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');

    Route::resource('authors', AuthorAdminController::class);
    Route::resource('categories', CategoryAdminController::class);
    Route::resource('comments', CommentAdminController::class);
    Route::resource('galleries', GalleryAdminController::class);
    Route::resource('multimedias', MultimediaAdminController::class);
    Route::resource('news', NewsAdminController::class);

    Route::resource('roles', RoleAdminController::class);
    Route::resource('users', UserAdminController::class);

});

Route::get('/test', function (Request $request) {
    
    // Google Drive
    // Storage::disk('google')->put('test.txt', 'Hello World');
    // return 'File was saved to Google Drive';
})->name('test');
