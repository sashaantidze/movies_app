<?php

namespace App\Http\Livewire;

use App\ViewModels\SearchViewModel;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchDropdown extends Component
{

	public $search = '';
	public $resultsAmount = 10;
	public $seeAllButton = false;
    public $searchEndpoint;
    public $controller;

    public function render()
    {
    	$searchResults = [];

    	if(strlen($this->search) > 2)
    	{
    		$searchResults = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/search/'.$this->defineSearchEndpoint()['endpoint'].'?query='.$this->search)->json()['results'];
    	}

    	if(count($searchResults) > $this->resultsAmount) $this->seeAllButton = true;

        $viewModel = new SearchViewModel(
            collect($searchResults)->take($this->resultsAmount), 
            $this->seeAllButton, 
            $this->defineSearchEndpoint()['ctrler']
        );

        return view('livewire.search-dropdown', $viewModel);
    }


    private function defineSearchEndpoint()
    {
        $endpoints = [];

        switch($this->controller)
        {
            case 'MoviesController':
                $endpoints['ctrler'] = 'movies';
                $endpoints['endpoint'] = 'movie';
                break;

            case 'TvController':
                $endpoints['ctrler'] = 'tv';
                $endpoints['endpoint'] = 'tv';
                break;

            case 'PeopleController':
                $endpoints['ctrler'] = 'people';
                $endpoints['endpoint'] = 'person';
                break;

            default:
                $endpoints['ctrler'] = 'movies';
                $endpoints['endpoint'] = 'movie';
        }

        return $endpoints;
    }



}
