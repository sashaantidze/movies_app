@extends('layouts.main')

@section('liveweire-search-component')
	<livewire:search-dropdown :controller="$controllerName">
@endsection

@section('content')

	<div class="container mx-auto px-4 pt-16">

		<div class="popular-movies">
			<h2 class="uppercase tracking-wider text-yellow-500 text-lg font-semibold">Popular Movies</h2>

			<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">

				@foreach($moviesData as $popMovie)

					<x-movie-card :movie="$popMovie" :genres="$genres"/>

				@endforeach
	
			</div>

		</div>



		<div class="now-playing-movies py-24">
			<h2 class="uppercase tracking-wider text-yellow-500 text-lg font-semibold">Now Playing</h2>

			<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">

				@foreach($nowPlaying as $movie)

					<x-movie-card :movie="$movie"/>

				@endforeach

				
			</div>

		</div>


	</div>

@endsection