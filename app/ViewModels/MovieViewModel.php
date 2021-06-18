<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{

    public $movie;
    public $similarMovies;
    public $recommendations;
    public $genres;

    public function __construct($movie, $genres)
    {
        
        $this->movie = $movie;
        $this->similarMovies = $movie['similar'];
        $this->recommendations = $movie['recommendations'];
        $this->genres = $genres;
    }

    public function similarMovies()
    {
        return $this->formatMovies(collect($this->similarMovies['results'])->sortByDesc('popularity'));
    }

    public function recommendations()
    {
        return $this->formatMovies(collect($this->recommendations['results'])->sortByDesc('popularity'));
    }

    public function movie()
    {
        return collect($this->movie)->merge([
            'poster_path' => $this->movie['poster_path'] ? config('services.tmdb.image_base_url')."/w500".$this->movie['poster_path'] : 'https://via.placeholder.com/500x737.png?text='.$this->movie['title'],
            'vote_average' => $this->movie['vote_average'] * 10 . '%',
            'release_date' => Carbon::parse($this->movie['release_date'])->format('M d, Y'),
            'genres' => collect($this->movie['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($this->movie['credits']['crew'])->take(5),
            'cast' => collect($this->movie['credits']['cast'])->take(10),
            'images' => collect($this->movie['images']['backdrops'])->take(12),
        ])->only([
            'poster_path', 'id', 'genres', 'title', 'vote_average', 'overview', 'release_date', 'credits' ,
            'videos', 'images', 'crew', 'cast', 'images', 'popularity'
        ]);
    }


    private function formatMovies($movies)
    {
        if(!collect($movies)->count()) return [];

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
                'genres',
                'popularity'
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
