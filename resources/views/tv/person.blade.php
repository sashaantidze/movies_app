@extends('layouts.main')

@section('page_title')TV Shows by {{$_GET['name']}} - @endsection

@section('liveweire-search-component')
	<livewire:search-dropdown :controller="$controllerName">
@endsection

@section('content')

	<div class="container mx-auto px-4 pt-16">
		
		<div class="popular-movies">
			<h2 class="uppercase tracking-wider text-yellow-500 text-lg font-semibold">TV Shows by <a href="{{route('people.show', $person_id)}}" class="italic text-red-600">{{$_GET['name']}}</a></h2>
			<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">

				@foreach($TvData as $tvshow)

					<x-tv-card :tvshow="$tvshow"/>

				@endforeach
	
			</div>

		</div>


	</div>

@endsection