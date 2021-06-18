<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{
    public $TvData;
    public $topRated;
    public $genres;
    public $keyword;
    public $page;

    public function __construct($TvData, $topRated, $genres, $keyword = '', $page = 1, $person_id = null)
    {
        $this->TvData = $TvData['results'];
        $this->topRated = $topRated['results'];
        $this->genres = $genres;
        $this->keyword = $keyword;
        $this->page = $page;
        $this->person_id = $person_id;

    }


    // public function baseMovID()
    // {
    //     return $this->base_movie_ID;
    // }


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
    

    public function TvData()
    {
        if(!collect($this->TvData)->count()) return [];
        return $this->formatTV(collect($this->TvData)->sortByDesc('popularity'));
        //return $this->formatTV($this->TvData);
    }

    public function topRated()
    {
        if(!collect($this->topRated)->count()) return [];
        return $this->formatTV(collect($this->topRated)->sortByDesc('popularity'));  
        //return $this->formatTV($this->topRated);
    }

    private function formatTV($tv)
    {
        //dd($tv);
        return collect($tv)->map(function($tvshow){

            $genresFormatted = collect($tvshow['genre_ids'])->mapWithKeys(function($value){
                return [$value => $this->genres()->get($value)];
            })->implode(', ');
            ;
            return collect($tvshow)->merge([
                'poster_path' => $tvshow['poster_path'] ? config('services.tmdb.image_base_url')."/w500".$tvshow['poster_path'] : 'https://via.placeholder.com/500x737.png?text='.$tvshow['name'],
                'vote_average' => $tvshow['vote_average'] * 10 . '%',
                'first_air_date' => Arr::exists($tvshow, 'first_air_date') ? Carbon::parse($tvshow['first_air_date'])->format('M d, Y') : 'Date not available',
                'genres' => $genresFormatted,
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
