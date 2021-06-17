<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $moviesData;
    public $nowPlaying;
    public $genres;
    public $keyword;
    public $page;

    public function __construct($moviesData, $nowPlaying, $genres, $keyword = '', $page = 1, $person_id = null)
    {
        //dd($moviesData);
        $this->moviesData = $this->defineMoviesDestination($moviesData);
        //$this->moviesData = $moviesData;
        $this->nowPlaying = $nowPlaying;
        $this->genres = $genres;
        $this->keyword = $keyword;
        $this->page = $page;
        $this->person_id = $person_id;
        $this->base_movie_ID = Arr::exists($moviesData, 'main_movie_id') ? $moviesData['main_movie_id'] : null;
        $this->main_mov_title = Arr::exists($moviesData, 'title') ? $moviesData['title'] : null;
        //dd($this->defineMoviesDestination($moviesData));

    }


    private function defineMoviesDestination($movies)
    {
        if(Arr::exists($movies, 'recommendations'))
        {
            return $movies['recommendations'];
        }
        else if(Arr::exists($movies, 'similar'))
        {
            return $movies['similar'];
        }
        else
        {
            return $movies;
        }
    }


    // public function baseMovTitle()
    // {
    //     return $this->main_mov_title;
    // }

    public function baseMovID()
    {
        return $this->base_movie_ID;
    }


    public function person_id()
    {
        return $this->person_id;
    }


    public function keyword()
    {
        return $this->keyword;
    }

    public function page()
    {
        return $this->page;
    }


    public function previous()
    {
        return $this->page > 1 ? $this->page - 1 : null;
    }


    public function next()
    {
        return $this->page < 500 ? $this->page + 1 : null;
    }
    

    public function moviesData()
    {
        if(!collect($this->moviesData)->count()) return [];
        return $this->formatMovies(collect($this->moviesData['results'])->sortByDesc('popularity'));
    }

    public function nowPlaying()
    {
        if(!collect($this->nowPlaying)->count()) return [];
        return $this->formatMovies(collect($this->nowPlaying['results'])->sortByDesc('popularity'));   
    }

    private function formatMovies($movies)
    {
        
        //dd($movies);
        return collect($movies)->map(function($movie){
            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function($value){
                return [$value => $this->genres()->get($value)];
            })->implode(', ');
            ;
            return collect($movie)->merge([
                'poster_path' => $movie['poster_path'] ? config('services.tmdb.image_base_url')."/w500".$movie['poster_path'] : 'https://via.placeholder.com/500x737.png?text='.$movie['title'],
                'vote_average' => $movie['vote_average'] * 10 . '%',
                'release_date' => Arr::exists($movie, 'release_date') ? Carbon::parse($movie['release_date'])->format('M d, Y') : 'Release date not available',
                'genres' => $genresFormatted,
            ])->only([
                'poster_path',
                'id',
                'genre_ids',
                'title',
                'vote_average',
                'overview',
                'release_date',
                'genres',
                'popularity',
            ]);
        })->sortByDesc('popularity');
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre){
            return [$genre['id'] => $genre['name']];
        });
    }
}
