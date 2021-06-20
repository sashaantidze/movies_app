<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Spatie\ViewModels\ViewModel;

class PersonViewModel extends ViewModel
{
    public $person;

    public function __construct($controller, $person, $social, $credits)
    {
        $this->person = $person;
        $this->social = $social;
        $this->credits = $credits;
        $this->controllerName = $controller;
    }


    public function person()
    {
        return collect($this->person)->merge([
            'birthday' => Carbon::parse($this->person['birthday'])->format('M d, Y'),
            'age' => Carbon::parse($this->person['birthday'])->age,
            'profile_path' =>  $this->person['profile_path'] ? "https://image.tmdb.org/t/p/w300_and_h450_face{$this->person['profile_path']}" : "https://ui-avatars.com/api/?size=235&name={$this->person['name']}"
        ]);
    }


    public function social()
    {
        return collect($this->social)->merge([
            'twitter'=> $this->social['twitter_id'] ? 'https://twitter.com/'.$this->social['twitter_id'] : null,
            'facebook'=> $this->social['facebook_id'] ? 'https://facebook.com/'.$this->social['facebook_id'] : null,
            'instagram'=> $this->social['instagram_id'] ? 'https://instagram.com/'.$this->social['instagram_id'] : null,
        ]);
    }


    public function controllerName()
    {
        return $this->controllerName;
    }


    public function knownFor()
    {

        $personCast = collect($this->credits)->get('cast');
        return collect($personCast)->sortByDesc('popularity')->take(5)->map(function($movie){
            if(Arr::exists($movie, 'title')){
                $title = $movie['title'];
            }
            else if(Arr::exists($movie, 'name')){
                $title = $movie['name'];
            }
            else{
                $title = 'Untitled';
            }
            return collect($movie)->merge([
                'poster_path' => $movie['poster_path'] ? config('services.tmdb.image_base_url')."/w185".$movie['poster_path'] : 'https://via.placeholder.com/500x737.png?text='.$movie['title'],
                'title' => $title,
                'movie_tv_link' => Arr::exists($movie, 'title') ? route('movies.show', $movie['id']) : route('tv.show', $movie['id'])
            ])->only(['poster_path', 'title', 'id', 'movie_tv_link']);
        });

    }


    public function credits()
    {
        $personCast = collect($this->credits)->get('cast');
        return collect($personCast)->map(function($movie){
            if(isset($movie['release_date'])){
                $releaseDate = $movie['release_date'];
            }
            else if(isset($movie['first_air_data'])){
                $releaseDate = $movie['first_air_data'];   
            }
            else{
                $releaseDate = '';
            }

            if(isset($movie['title'])){
                $title = $movie['title'];
            }
            else if(isset($movie['name'])){
                $title = $movie['name'];   
            }
            else{
                $title = '';
            }

            return collect($movie)->merge([
                'release_date' => $releaseDate,
                'release_year' => isset($releaseDate) ? Carbon::parse($releaseDate)->format('Y') : 'Future',
                'title' => $title,
                'character' => isset($movie['character']) ? $movie['character'] : '',
            ]);
        })->sortByDesc('release_date');

    }
}
