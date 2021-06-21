@extends('layouts.main')

@section('page_title') Seasons - @endsection

@section('content')

	<div class="container mx-auto px-4 pt-16 mb-10">

		<div class="popular-movies">
			<h2 class="uppercase tracking-wider text-yellow-500 text-lg font-semibold"><a href="{{route('tv.show', $tvshow['id'])}}" class="text-red-500">{{$tvshow['name']}}</a> - Seasons</h2>

			<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">

				@foreach($tvshow['seasons'] as $season)

					<x-tv-season-card :season="$season" :tvv="$tvshow"/>	
				@endforeach
	
			</div>

		</div>


	</div>

@endsection