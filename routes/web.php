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

Route::get('/', 'HomeController@home');
Route::get('/blogs/{slug}', 'HomeController@show');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});



Auth::routes();

Route::get('/admin/dashboard', 'HomeController@index')->name('home');

Route::get('blogs/{id}', 'BlogsController@show')->name('blogs.show');



Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function () {
    Route::get('/blogs', 'Admin\BlogController@indexPublished')->name('admin.blogs.index-published');
    Route::get('/blogs/create', 'Admin\BlogController@create')->name('admin.blogs.create');
    Route::post('/blogs/create', 'Admin\BlogController@store')->name('admin.blogs.store');
    Route::get('/blogs/{blog}/edit', 'Admin\BlogController@edit')->name('admin.blogs.edit');
    Route::put('/blogs/{blog}', 'Admin\BlogController@update')->name('admin.blogs.update');
});


