<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Spatie\ViewModels\ViewModel;

class TVShowViewModel extends ViewModel
{

    public $tvshow;
    public $similarShows;
    public $recommendations;
    public $genres;
    public $controllerName;

    public function __construct($controller, $tvshow, $genres)
    {
        $this->tvshow = $tvshow;
        $this->genres = $genres;
        $this->controllerName = $controller;
        $this->similarShows = $tvshow['similar'];
        $this->recommendations = $tvshow['recommendations'];
    }

    public function controllerName()
    {
        return $this->controllerName;
    }


    public function tvshow()
    {
        return collect($this->tvshow)->merge([
            'poster_path' => $this->tvshow['poster_path'] ? config('services.tmdb.image_base_url')."/w500".$this->tvshow['poster_path'] : 'https://via.placeholder.com/500x737.png?text='.$this->tvshow['name'],
            'vote_average' => $this->tvshow['vote_average'] * 10 . '%',
            'first_air_date' => Carbon::parse($this->tvshow['first_air_date'])->format('M d, Y'),
            'genres' => collect($this->tvshow['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($this->tvshow['credits']['crew'])->take(5),
            'cast' => collect($this->tvshow['credits']['cast'])->take(10),
            'images' => collect($this->tvshow['images']['backdrops'])->take(12),
            'seasons' => collect($this->tvshow['seasons'])->map(function($season){
                return collect($season)->merge([
                    'poster_path' => $season['poster_path'] ? config('services.tmdb.image_base_url')."/w500".$season['poster_path'] : 'https://via.placeholder.com/500x737.png?text='.$season['name'],
                    'air_date' => Carbon::parse($season['air_date'])->format('M d, Y'),
                    'parent_tvshow_id' => $this->tvshow['id']
                ]);
            })
        ])->only([
            'poster_path', 'id', 'genres', 'name', 'vote_average', 'overview', 'first_air_date', 'credits' ,
            'videos', 'images', 'crew', 'cast', 'images', 'popularity', 'created_by', 'seasons', 'parent_tvshow_id'
        ]);
    }



    public function similarShows()
    {
        return $this->formatTVshows(collect($this->similarShows['results'])->sortByDesc('popularity'));
    }

    public function recommendations()
    {
        return $this->formatTVshows(collect($this->recommendations['results'])->sortByDesc('popularity'));
    }


    private function formatTVshows($tvshows)
    {
        if(!collect($tvshows)->count()) return [];

        return collect($tvshows)->map(function($tvshow){
            $genresFormatted = collect($tvshow['genre_ids'])->mapWithKeys(function($value){
                return [$value => $this->genres()->get($value)];
            })->implode(', ');
            ;
            return collect($tvshow)->merge([
                'poster_path' => $tvshow['poster_path'] ? config('services.tmdb.image_base_url')."/w500".$tvshow['poster_path'] : 'https://via.placeholder.com/500x737.png?text='.$tvshow['name'],
                'vote_average' => $tvshow['vote_average'] * 10 . '%',
                'first_air_date' => Arr::exists($tvshow, 'first_air_date') ? Carbon::parse($tvshow['first_air_date'])->format('M d, Y') : 'Release date not available',
                'genres' => $genresFormatted
            ])->only([
                'poster_path',
                'id',
                'genre_ids',
                'name',
                'vote_average',
                'overview',
                'first_air_date',
                'genres',
                'popularity',
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
