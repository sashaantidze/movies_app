<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class PeopleViewModel extends ViewModel
{

    public $people;
    public $page;
    public $controllerName;

    public function __construct($controller, $people, $keyword = '', $page = 1)
    {
        $this->people = $people;
        $this->keyword = $keyword;
        $this->page = $page;
        $this->controllerName = $controller;

        //dd($people);
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
            ]);
        });
    }


    public function controllerName()
    {
        return $this->controllerName;
    }


    public function page()
    {
        return $this->page;
    }


    public function previous()
    {
        return (int)$this->page > 1 ? (int)$this->page - 1 : null;
    }


    public function next()
    {
        return (int)$this->page < 500 ? (int)$this->page + 1 : null;
    }


    public function keyword()
    {
        return $this->keyword;
    }



}



