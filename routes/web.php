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

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/authors/add', 'AuthorController@add');
Route::get('/authors/{id}/edit', 'AuthorController@edit');
Route::get('/authors/list', 'AuthorController@list');
Route::get('/authors', 'AuthorController@index')->name('authors');

Route::post('/authors/store', 'AuthorController@store');
Route::post('/authors/{id}/alter', 'AuthorController@alter');
Route::post('/authors/{id}/delete', 'AuthorController@delete');

Route::get('/tags/add', 'TagController@add');
Route::get('/tags/{id}/edit', 'TagController@edit');
Route::get('/tags/list', 'TagController@list');
Route::get('/tags', 'TagController@index')->name('tags');

Route::post('/tags/store', 'TagController@store');
Route::post('/tags/{id}/alter', 'TagController@alter');
Route::post('/tags/{id}/delete', 'TagController@delete');
