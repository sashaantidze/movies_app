<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Arr;
use App\ViewModels\MovieViewModel;
use App\ViewModels\MoviesViewModel;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;


class MoviesController extends Controller
{


    public $user_rating;
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
            $this->getControllerName(),
            $popularMovies,
            $nowPlaying,
            $this->getGenres()
        );


        return view('movies.index', $viewModel);
    }


    public function rating($rating, $movie_id)
    {
        if(Cookie::get('guestSessionID') !== null)
        {
            $session_id = Cookie::get('guestSessionID');
            return $this->submitMovieRating($movie_id, $session_id, $rating);
        }
        else
        {
            return $this->getRequestToken($rating, $movie_id);
        }
    }


    public function getRequestToken($rating, $movie_id)
    {
        $requestToken = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/authentication/token/new')->json();
        if(isset($requestToken['success']) && $requestToken['success'] == true)
        {
            Session::flash('rating_'.$movie_id, $rating);
            $domainName = Request::getHost();
            $authorizeURL = 'https://www.themoviedb.org/authenticate/'.$requestToken['request_token'].'?redirect_to=http://'.$domainName.'/movies/session/'.$movie_id;
            $requestToken['msg'] = 'Please authenticate TMDB session in order to proceed';
            $requestToken['sub_msg'] = '<a href="'.$authorizeURL.'">Authenticate</a>';
            $requestToken['status'] = 'warning';
        }

        return response()->json($requestToken, 200);
    }




    public function session($movie_id)
    {
        $response = [];

        $guest_session = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/authentication/guest_session/new')->json();

        if(isset($_GET['denied']) && $_GET['denied'] == true)
        {
            $response['msg'] = 'Authorization has been cancelled';
            $response['sub_msg'] = '';
            $response['status'] = 'error';
            $response['success'] = false;
        }
        else
        {
            if(isset($guest_session['success']) && $guest_session['success'] == true)
            {
                Cookie::queue(Cookie::forever('guestSessionID', $guest_session['guest_session_id']));
                $rate_endpoint = $this->submitMovieRating($movie_id, $guest_session['guest_session_id'], Session::get('rating_'.$movie_id), false);

                if($rate_endpoint['status'] == 'success'){
                    $sub_msg = 'Your rating has been saved.';
                }
                else if($rate_endpoint['status'] == 'error'){
                    $sub_msg = 'But rating could not be saved, please try again.';   
                }
                else{
                    $sub_msg = 'You can now rate your favorite movies';
                }

                $response['msg'] = 'You have been authorized!';
                $response['sub_msg'] = $sub_msg;
                $response['status'] = 'success';
                $response['success'] = true;
            }
            else
            {
                $response['msg'] = 'Something went wrong!';
                $response['sub_msg'] = 'there has been a problem authorising your session';
                $response['status'] = 'error';
                $response['success'] = false;           
            }
        }


        Session::flash('tmdb_session_status', $response);

        return redirect()->route('movies.show', $movie_id);
    }


    public function submitMovieRating($movie_id, $guestSessionID, $rating, $returnResponse = true)
    {
        //dd($this->updatedRatedMoviesData());
        $response = Http::withToken(config('services.tmdb.token'))->post('https://api.themoviedb.org/3/movie/'.$movie_id.'/rating?guest_session_id='.$guestSessionID, ['value'=>(int)$rating])->json();
        if($response['success'] === true){
            $cookie_entry = ['movie_'.$movie_id => 'movie__'.$movie_id.'__'.$rating.'__'.$guestSessionID];

            $this->updatedRatedMoviesData($cookie_entry);

            $response['msg'] = 'Done, rated: '.$rating;
            $response['sub_msg'] = $response['status_message'];
            $response['status'] = 'success';
        }
        else{
            $response['msg'] = 'Daamn..';
            $response['sub_msg'] = $response['status_message'];
            $response['status'] = 'error';
        }

        if(!$returnResponse){
            return $response;
        }

        return response()->json($response, 200);
    }



    private function updatedRatedMoviesData($cookieData = null)
    {
        $cookieEntries = [];
        if(Cookie::has('movieRatingsData')){
            $cookieEntries = json_decode(Cookie::get('movieRatingsData'));
            $cookieEntries[] = $cookieData;

            Cookie::queue(Cookie::forever('movieRatingsData', json_encode($cookieEntries)));
        }
        else{
            Cookie::queue(Cookie::forever('movieRatingsData', json_encode([$cookieData])));
        }

        return $cookieEntries;
    }


    public function similar($id)
    {
        $similarMovies = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/'.$id.'?append_to_response=details,similar')->json();
        $similarMovies['main_movie_id'] = $id;

        //dd($similarMovies);

        $viewModel = new MoviesViewModel(
            $this->getControllerName(),
            $similarMovies,
            [],
            $this->getGenres()
        );
        
        return view('movies.similar', $viewModel);
    }


    public function recommendation($id)
    {
        $recommMovies = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/'.$id.'?append_to_response=details,recommendations')->json();
        $recommMovies['main_movie_id'] = $id;

        //dd($recommMovies);

        $viewModel = new MoviesViewModel(
            $this->getControllerName(),
            $recommMovies,
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
        $viewModel = new MoviesViewModel($this->getControllerName(), $personMovies, [], $this->getGenres(), '', 1, $id);
        return view('movies.person', $viewModel);
    }


    private function getGenres()
    {
        return $MovieGenres = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/genre/movie/list')->json()['genres'];
    }


    public function search($search, $page = 1)
    {
        $searchResults = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/search/movie?query='.$search.'&page='.$page)->json();
        $MovieGenres = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/genre/movie/list')->json();
        $genres = $MovieGenres['genres'];

        $viewModel = new MoviesViewModel(
            $this->getControllerName(),
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
        if(isset($_GET['approved']) && $_GET['approved'] == true && isset($_GET['request_token'])){
            $req_token = $_GET['request_token'];

        }

        $movieDetails = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/'.$id.'?append_to_response=credits,videos,images,similar,recommendations')->json();
        
        $viewModel = new MovieViewModel($this->getControllerName(), $movieDetails, $this->getGenres());

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
