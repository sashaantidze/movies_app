@extends('layouts.main')

@section('content')

	<div class="container mx-auto px-4 py-16">

		<div class="popular-movies">
			<h2 class="uppercase tracking-wider text-yellow-500 text-lg font-semibold">Search results for <span class="italic text-yellow-300 normal-case font-normal tracking-widest">"{{$keyword}}"</span></h2>

			<div class="grid movgrid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">

				@foreach($popularMovies as $popMovie)

					<x-movie-card :movie="$popMovie" :genres="$genres"/>

				@endforeach
	
			</div>

		</div>

		<div class="page-load-status my-8">
			<p class="infinite-scroll-request my-8 sp text-4xl spinner">
				<x-people-svg-loader/>
			</p>
			<p class="infinite-scroll-last">End of content</p>
  			<p class="infinite-scroll-error">No more pages to load</p>
		</div>


		<div class="flex justify-between mt-16 hidden">
			@if($previous)
				<a href="/movies/search/{{$keyword}}/{{$previous}}">Previous</a>
			@else
				<div></div>
			@endif
			
			@if($next)
				<a class="infin-pag-next" href="/movies/search/{{$keyword}}/{{$next}}">Next</a>
			@else
				<div></div>
			@endif

		</div>


	</div>

@endsection

@section('scripts')


	<script>
		
		let elem = document.querySelector('.movgrid');
		let infScroll = new InfiniteScroll( elem, {
		  // options
		  path: '.infin-pag-next',
		  append: '.movie',
		  // history: false,
		  status: '.page-load-status',
		});


	</script>

@endsection