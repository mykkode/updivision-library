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

Route::get('/authors/{id}/edit', 'AuthorController@edit');
Route::get('/authors/add', 'AuthorController@add');
Route::get('/authors/list', 'AuthorController@list');
Route::get('/authors', 'AuthorController@index')->name('authors');

Route::post('/authors/store', 'AuthorController@store');
Route::post('/authors/alter', 'AuthorController@alter');
Route::post('/authors/{id}/delete', 'AuthorController@delete');

