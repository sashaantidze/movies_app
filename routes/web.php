<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'App\Http\Controllers\MoviesController@index')->name('movies.index');
Route::get('/movies/{movie}', 'App\Http\Controllers\MoviesController@show')->name('movies.show');
Route::get('/movies/person/{person}', 'App\Http\Controllers\MoviesController@person')->name('movies.person');
Route::get('/movies/similar/{movie}/{page?}', 'App\Http\Controllers\MoviesController@similar')->name('movies.similar');
Route::get('/movies/recommendation/{movie}/{page?}', 'App\Http\Controllers\MoviesController@recommendation')->name('movies.recommendation');

Route::get('/movies/search/{keyword}/{page?}', 'App\Http\Controllers\MoviesController@search')->name('movies.search');
Route::get('/people/search/{keyword}/{page?}', 'App\Http\Controllers\PeopleController@search')->name('people.search');
Route::get('/tv/search/{keyword}/{page?}', 'App\Http\Controllers\TvController@search')->name('tv.search');

Route::get('movies/rating/{rating}/{movie_id}', 'App\Http\Controllers\MoviesController@rating');
Route::get('movies/session/{movie_id}', 'App\Http\Controllers\MoviesController@session');

Route::get('/tv', 'App\Http\Controllers\TvController@index')->name('tv.index');
Route::get('/tv/{tv}', 'App\Http\Controllers\TvController@show')->name('tv.show');
Route::get('/tv/person/{person}', 'App\Http\Controllers\TvController@person')->name('tv.person');
Route::get('/tv/{tv}/seasons', 'App\Http\Controllers\TvController@seasons')->name('tv.seasons');
Route::get('/tv/{tv}/season/{season}', 'App\Http\Controllers\TvController@season')->name('tv.season');


Route::get('/people', 'App\Http\Controllers\PeopleController@index')->name('people.index');
Route::get('/people/{person}', 'App\Http\Controllers\PeopleController@show')->name('people.show');
Route::get('/people/page/{page?}', 'App\Http\Controllers\PeopleController@index');
Route::get('/people/{person}', 'App\Http\Controllers\PeopleController@show')->name('people.show');