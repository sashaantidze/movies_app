@extends('layouts.main')

@section('content')

	<div class="container mx-auto px-4 py-16">

		<div class="popular-movies">
			<h2 class="uppercase tracking-wider text-yellow-500 text-lg font-semibold">Similar movies for <span class="italic text-yellow-300 normal-case font-normal tracking-widest">"{{}}"</span></h2>

			<div class="grid movgrid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">

				@foreach($moviesData as $popMovie)

					<x-movie-card :movie="$popMovie" :genres="$genres"/>

				@endforeach
	
			</div>

		</div>

	</div>

@endsection
