<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'App\Http\Controllers\MoviesController@index')->name('movies.index');
Route::get('/movies/{movie}', 'App\Http\Controllers\MoviesController@show')->name('movies.show');
Route::get('/movies/search/{keyword}/{page?}', 'App\Http\Controllers\MoviesController@search')->name('movies.search');
Route::get('/movies/person/{person}', 'App\Http\Controllers\MoviesController@person')->name('movies.person');

Route::get('/people', 'App\Http\Controllers\PeopleController@index')->name('people.index');
Route::get('/people/{person}', 'App\Http\Controllers\PeopleController@show')->name('people.show');
Route::get('/people/page/{page?}', 'App\Http\Controllers\PeopleController@index');

Route::get('/people/{person}', 'App\Http\Controllers\PeopleController@show')->name('people.show');

