<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class SearchViewModel extends ViewModel
{
    public $searchResults;
    public $seeAllButton;
    public $searchEndpoint;

    public function __construct($search, $button, $endpoint)
    {
        //dd($endpoint);
        $this->searchResults = $search;
        $this->seeAllButton = $button;
        $this->searchEndpoint = $endpoint === 'person' ? 'people' : $endpoint;

    }


    public function searchResults()
    {
        return collect($this->searchResults)->map(function ($result){
            return collect($result)->merge([
                'title' => isset($result['title']) ? $result['title'] : $result['name'],
                'poster_path' => isset($result['profile_path']) ? $result['profile_path'] : (isset($result['poster_path']) ? $result['poster_path'] : '')
            ]);
        });
    }


    public function seeAllButton()
    {
        return $this->seeAllButton;
    }


    public function search_endpoint()
    {
        return $this->searchEndpoint;
    }

}
