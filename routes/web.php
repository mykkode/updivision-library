<?php

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

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('authors')->group(function () {
    Route::get('/add', 'AuthorController@add')->middleware('auth');
	Route::get('/{id}/edit', 'AuthorController@edit')->middleware('auth');
	Route::get('/list', 'AuthorController@list')->middleware('auth');
	Route::get('/', 'AuthorController@index')->name('authors')->middleware('auth');

	Route::post('/store', 'AuthorController@store')->middleware('auth');
	Route::post('/{id}/alter', 'AuthorController@alter')->middleware('auth');
	Route::post('/{id}/delete', 'AuthorController@delete')->middleware('auth');
});


Route::prefix('tags')->group(function () {
	Route::get('/add', 'TagController@add')->middleware('auth');
	Route::get('/{id}/edit', 'TagController@edit')->middleware('auth');
	Route::get('/list', 'TagController@list')->middleware('auth');
	Route::get('/', 'TagController@index')->name('tags')->middleware('auth');

	Route::post('/store', 'TagController@store')->middleware('auth');
	Route::post('/{id}/alter', 'TagController@alter')->middleware('auth');
	Route::post('/{id}/delete', 'TagController@delete')->middleware('auth');
});

Route::prefix('books')->group(function () {
	Route::get('/add', 'BookController@add')->middleware('auth');
	Route::get('/{id}/edit', 'BookController@edit')->middleware('auth');
	Route::get('/list/{id?}', 'BookController@list')->middleware('auth');
	Route::get('/bind/{book_id}/{tag_id}', 'BookController@bind')->middleware('auth');
	Route::get('/unbind/{book_id}/{tag_id}', 'BookController@unbind')->middleware('auth');
	Route::get('/', 'BookController@index')->name('books')->middleware('auth');

	Route::post('/store', 'BookController@store')->middleware('auth');
	Route::post('/{id}/alter', 'BookController@alter')->middleware('auth');
	Route::post('/{id}/delete', 'BookController@delete')->middleware('auth');
});

Route::get('activate/{id}', 'Auth\RegisterController@activate')->middleware('auth');