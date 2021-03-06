<?php

namespace App\Http\Controllers;

use App\ViewModels\PeopleViewModel;
use App\ViewModels\PersonViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page = 1)
    {
        abort_if($page > 500, 204);

        $popularPeople = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/person/popular?page='.$page)->json()['results'];

        $viewModel = new PeopleViewModel($this->getControllerName(), $popularPeople, $page);

        return view('people.index', $viewModel);
    }


    public function search($search, $page = 1)
    {
        $searchResults = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/search/person?query='.$search.'&page='.$page)->json();

        $viewModel = new PeopleViewModel(
            $this->getControllerName(),
            $searchResults['results'],
            $search,
            $page
        );

        return view('people.search', $viewModel);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $person = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/person/'.$id)->json();
        $socialNets = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/person/'.$id.'/external_ids')->json();
        $combinedCredits = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/person/'.$id.'/combined_credits')->json();
        
        $viewModel = new PersonViewModel($this->getControllerName(),$person, $socialNets, $combinedCredits);

        return view('people.show', $viewModel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
