<?php

namespace App\Http\Controllers;

use App\ViewModels\TVSeasonViewModel;
use App\ViewModels\TVShowViewModel;
use App\ViewModels\TvViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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
            $this->getControllerName(),
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


    public function person($id)
    {
        $personTvshows = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/person/'.$id.'/tv_credits')->json();
        abort_if(Arr::exists($personTvshows, 'success') && $personTvshows['success'] == false, 404);
        //dd($personTvshows);

        $personTvshows['results'] = $personTvshows['cast'];
        $viewModel = new TvViewModel($this->getControllerName(), $personTvshows, ['results' => []], $this->getGenres(), '', 1, $id);
        return view('tv.person', $viewModel);

    }


    public function seasons($id)
    {
        $TvSeasons = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/tv/'.$id.'?append_to_response=credits,videos,images,similar,recommendations')->json();

        //dd($TvSeasons);

        $viewModel = new TVShowViewModel($TvSeasons, $this->getGenres());

        return view('tv.seasons', $viewModel);
    }


    public function season($id, $season_num)
    {
        $seasonDeatils = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/tv/'.$id.'/season/'.$season_num.'?append_to_response=credits,videos,images')->json();

        //dd($seasonDeatils);
        $viewModel = new TVSeasonViewModel($seasonDeatils);

        return view('tv.season', $viewModel);
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
