<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'App\Http\Controllers\MoviesController@index')->name('movies.index');
Route::get('/movies/{movie}', 'App\Http\Controllers\MoviesController@show')->name('movies.show');
Route::get('/movies/search/{keyword}/{page?}', 'App\Http\Controllers\MoviesController@search')->name('movies.search');
Route::get('/movies/person/{person}', 'App\Http\Controllers\MoviesController@person')->name('movies.person');
Route::get('/movies/similar/{movie}/{page?}', 'App\Http\Controllers\MoviesController@similar')->name('movies.similar');
Route::get('/movies/recommendation/{movie}/{page?}', 'App\Http\Controllers\MoviesController@recommendation')->name('movies.recommendation');


Route::get('/tv', 'App\Http\Controllers\TvController@index')->name('tv.index');
Route::get('/tv/{tv}', 'App\Http\Controllers\TvController@show')->name('tv.show');
Route::get('/tv/person/{person}', 'App\Http\Controllers\TvController@person')->name('tv.person');


Route::get('/people', 'App\Http\Controllers\PeopleController@index')->name('people.index');
Route::get('/people/{person}', 'App\Http\Controllers\PeopleController@show')->name('people.show');
Route::get('/people/page/{page?}', 'App\Http\Controllers\PeopleController@index');
Route::get('/people/{person}', 'App\Http\Controllers\PeopleController@show')->name('people.show');