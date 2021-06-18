@extends('layouts.main')

@section('content')

	<div class="container mx-auto px-4 pt-16">
		
		<div class="popular-movies">
			<h2 class="uppercase tracking-wider text-yellow-500 text-lg font-semibold">Movies by <a href="{{route('people.show', $person_id)}}" class="italic text-red-600">{{$_GET['name']}}</a></h2>
			<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">

				@foreach($moviesData as $popMovie)

					<x-movie-card :movie="$popMovie" :genres="$genres"/>

				@endforeach
	
			</div>

		</div>


	</div>

@endsection