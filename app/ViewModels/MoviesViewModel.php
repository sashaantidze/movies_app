<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $popularMovies;
    public $nowPlaying;
    public $genres;
    public $keyword;
    public $page;

    public function __construct($popularMovies, $nowPlaying, $genres, $keyword = '', $page = 1)
    {
        $this->popularMovies = $popularMovies;
        $this->nowPlaying = $nowPlaying;
        $this->genres = $genres;
        $this->keyword = $keyword;
        $this->page = $page;
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
    

    public function popularMovies()
    {
        return $this->formatMovies($this->popularMovies);
    }

    public function nowPlaying()
    {
        return $this->formatMovies($this->nowPlaying);   
    }

    private function formatMovies($movies)
    {
        if(!collect($movies)->count()) return [];
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
                'genres' => $genresFormatted
            ])->only([
                'poster_path',
                'id',
                'genre_ids',
                'title',
                'vote_average',
                'overview',
                'release_date',
                'genres'
            ]);
        });
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre){
            return [$genre['id'] => $genre['name']];
        });
    }
}
