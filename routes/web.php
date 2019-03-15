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
    Route::get('/add', 'AuthorController@add');
	Route::get('/{id}/edit', 'AuthorController@edit');
	Route::get('/list', 'AuthorController@list');
	Route::get('/', 'AuthorController@index')->name('authors');

	Route::post('/store', 'AuthorController@store');
	Route::post('/{id}/alter', 'AuthorController@alter');
	Route::post('/{id}/delete', 'AuthorController@delete');
});


Route::prefix('tags')->group(function () {
	Route::get('/add', 'TagController@add');
	Route::get('/{id}/edit', 'TagController@edit');
	Route::get('/list', 'TagController@list');
	Route::get('/', 'TagController@index')->name('tags');

	Route::post('/store', 'TagController@store');
	Route::post('/{id}/alter', 'TagController@alter');
	Route::post('/{id}/delete', 'TagController@delete');
});

Route::prefix('books')->group(function () {
	Route::get('/add', 'BookController@add');
	Route::get('/{id}/edit', 'BookController@edit');
	Route::get('/list/{id?}', 'BookController@list');
	Route::get('/bind/{book_id}/{tag_id}', 'BookController@bind');
	Route::get('/unbind/{book_id}/{tag_id}', 'BookController@unbind');
	Route::get('/', 'BookController@index')->name('books');

	Route::post('/store', 'BookController@store');
	Route::post('/{id}/alter', 'BookController@alter');
	Route::post('/{id}/delete', 'BookController@delete');
});

Route::get('activate/{id}', 'Auth\RegisterController@activate');