<?php

namespace App\Http\Controllers;

use App\ViewModels\MovieViewModel;
use App\ViewModels\MoviesViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/popular')->json();
        $nowPlaying = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/now_playing')->json();
        

        $viewModel = new MoviesViewModel(
            $popularMovies,
            $nowPlaying,
            $this->getGenres()
        );


        return view('movies.index', $viewModel);
    }


    public function similar($id)
    {
        $similarMovies = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/'.$id.'/similar')->json();
        $similarMovies['main_movie_id'] = $id;

        $viewModel = new MoviesViewModel(
            $similarMovies,
            [],
            $this->getGenres()
        );
        
        return view('movies.similar', $viewModel);
    }


    public function reccomendations($id)
    {
        $recommMovies = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/'.$id.'/recommendations')->json();
        $recommMovies['main_movie_id'] = $id;

        $viewModel = new MoviesViewModel(
            $similarMovies,
            [],
            $this->getGenres()
        );
        
        return view('movies.recommendation', $viewModel);
    }


    public function person($id)
    {
        $personMovies = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/person/'.$id.'/movie_credits')->json();
        abort_if(Arr::exists($personMovies, 'success') && $personMovies['success'] == false, 404);

        $personMovies['results'] = $personMovies['cast'];
        $viewModel = new MoviesViewModel($personMovies, [], $this->getGenres(), '', 1, $id);
        return view('movies.person', $viewModel);
    }


    private function getGenres()
    {
        return $MovieGenres = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/genre/movie/list')->json()['genres'];
    }


    public function search($search, $page = 1)
    {
        $searchResults = $popularMovies = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/search/movie?query='.$search.'&page='.$page)->json();
        $MovieGenres = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/genre/movie/list')->json();
        $genres = $MovieGenres['genres'];

        $viewModel = new MoviesViewModel(
            $searchResults,
            [],
            $genres,
            $search,
            $page
        );

        return view('movies.search', $viewModel);
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
        $movieDetails = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/'.$id.'?append_to_response=credits,videos,images,similar,recommendations')->json();
        
        $viewModel = new MovieViewModel($movieDetails, $this->getGenres());

        return view('movies.show', $viewModel);
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
