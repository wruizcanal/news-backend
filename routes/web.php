<?php

use App\Http\Controllers\Backend\DashboardAdminController;
use App\Models\Author;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Gallery;
use App\Models\Multimedia;
use App\Models\News;
use Illuminate\Support\Facades\Route;
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
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');

    Route::resource('roles', RoleAdminController::class);
    Route::resource('users', UserAdminController::class);

});

Route::get('/testing', function () {
    $author = Author::query()->first();
    $author2 = Author::query()->whereNot('id', $author->id)->first();
    $category = Category::query()->first();
    $comment = Comment::query()->first();
    $gallery = Gallery::query()->first();
    $news = News::query()->first();
    $multimedia = Multimedia::query()->first();

    $var = [
        'Authors'=> Author::all(),
        'Authors-News'=> $author->news,
        'Authors-Multimedias'=> $author2->multimedias,
        'Category'=> Category::all(),
        'Category-News'=> $category->news,
        'Comment'=> Comment::all(),
        'Comment-News'=> $comment->news,
        'Gallery'=> Gallery::all(),
        'Gallery-Multimedia'=> $gallery->multimedias,
        'News'=> News::all(),
        'News-Category'=> $news->category,
        'News-Author'=> $news->author,
        'News-CoverPicture'=> $news->coverPicture,
        'Multimedia'=> Multimedia::all(),
        'Multimedia-Author'=> $multimedia->author,
        'Multimedia-Gallery'=> $multimedia->gallery,
        'Multimedia-News'=> $multimedia->news,
    ];
    
    return $var;
});

Route::get('/test', function () {

    Storage::disk('google')->put('test.txt', 'Hello World');
    //Storage::cloud()->put('test.txt', 'Hello World');
    return 'File was saved to Google Drive';
})->name('test');
