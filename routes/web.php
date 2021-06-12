<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'App\Http\Controllers\MoviesController@index')->name('movies.index');
Route::get('/movies/{movie}', 'App\Http\Controllers\MoviesController@show')->name('movies.show');

Route::get('/people', 'App\Http\Controllers\PeopleController@index')->name('people.index');
Route::get('/people/{person}', 'App\Http\Controllers\PeopleController@show')->name('people.show');

