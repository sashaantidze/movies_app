<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TVSeasonViewModel extends ViewModel
{

    public $seasonDetails;

    public function __construct($season)
    {
        $this->seasonDetails = $season;
    }



    public function season()
    {
        return collect($this->seasonDetails)->merge([
            'poster_path' => $this->seasonDetails['poster_path'] ? config('services.tmdb.image_base_url')."/w500".$this->seasonDetails['poster_path'] : 'https://via.placeholder.com/500x737.png?text='.$this->seasonDetails['name'],
            'air_date' => Carbon::parse($this->seasonDetails['air_date'])->format('M d, Y'),
            'crew' => collect($this->seasonDetails['credits']['crew'])->take(5),
            'cast' => collect($this->seasonDetails['credits']['cast'])->take(10),
            'images' => collect($this->seasonDetails['images']['posters'])->take(12),
            'episodes' => collect($this->seasonDetails['episodes'])->map(function($episode){
                return collect($episode)->merge([
                    'still_path' => $episode['still_path'] ? config('services.tmdb.image_base_url')."/w500".$episode['still_path'] : 'https://via.placeholder.com/500x737.png?text='.$episode['name'],
                    'air_date' => Carbon::parse($episode['air_date'])->format('M d, Y'),
                ]);
            })
        ])->only([
            'poster_path', 'id', 'genres', 'name', 'vote_average', 'overview', 'air_date', 'credits' ,
            'videos', 'images', 'crew', 'cast', 'images', 'popularity', 'created_by', 'episodes', 'parent_tvshow_id'
        ]);
    }

}
