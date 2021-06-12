<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class PeopleViewModel extends ViewModel
{

    public $people;

    public function __construct($people)
    {
        $this->people = $people;
    }


    public function popularPoeple()
    {
        return collect($this->people)->map(function($person){

            return collect($person)->merge([
                'profile_path' =>  $person['profile_path'] ? "https://image.tmdb.org/t/p/w235_and_h235_face{$person['profile_path']}" : "https://ui-avatars.com/api/?size=235&name={$person['name']}", //TODO: set config for people images path
                'known_for' => collect($person['known_for'])->where('media_type', 'movie')->pluck('title')->union(
                    collect($person['known_for'])->where('media_type', 'tv')->pluck('name')
                )->implode(', ')
            ])->only([
                'profile_path',
                'known_for',
                'name',
                'id',
            ])->dump();
        });
    }
}
