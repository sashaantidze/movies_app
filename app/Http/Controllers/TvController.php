<?php

namespace App\Http\Controllers;

use App\ViewModels\TVShowViewModel;
use App\ViewModels\TvViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popularShows = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/tv/popular')->json();
        $topRatedShows = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/tv/top_rated')->json();
        

        $viewModel = new TvViewModel(
            $popularShows,
            $topRatedShows,
            $this->getGenres()
        );


        return view('tv.index', $viewModel);
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
        $TvDetails = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/tv/'.$id.'?append_to_response=credits,videos,images,similar,recommendations')->json();


        //dd($TvDetails);
        $viewModel = new TVShowViewModel($TvDetails, $this->getGenres());

        return view('tv.show', $viewModel);
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


    private function getGenres()
    {
        return $MovieGenres = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/genre/tv/list')->json()['genres'];
    }
}
