<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchDropdown extends Component
{

	public $search = '';
	public $resultsAmount = 10;
	public $seeAllButton = false;

    public function render()
    {

    	$searchResults = [];

    	if(strlen($this->search) > 2)
    	{
    		$searchResults = $popularMovies = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/search/movie?query='.$this->search)->json()['results'];
    	}

    	if(count($searchResults) > $this->resultsAmount)
    	{
    		$this->seeAllButton = true;
    	}

        return view('livewire.search-dropdown', [
        	'searchResults' => collect($searchResults)->take($this->resultsAmount),
        	'seeAllButton' => $this->seeAllButton
        ]);
    }
}
