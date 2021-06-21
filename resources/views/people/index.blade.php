@extends('layouts.main')

@section('page_title')People - @endsection

@section('liveweire-search-component')
	<livewire:search-dropdown :controller="$controllerName">
@endsection

@section('content')
	<div class="container mx-auto px-4 py-16">
		<div class="popular-actors">
			<h2 class="uppercase tracking-wider text-yellow-500 text-lg font-semibold">Popular Actors</h2>

			<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">

				@foreach($popularPoeple as $person)

					<div class="actor mt-8">
						<a href="{{route('people.show', $person['id'])}}">
							<img src="{{$person['profile_path']}}" alt="Main image" class="hover:opacity-75 transition ease-in-out duration-150">
						</a>
						<div class="mt-2">
							<a href="{{route('people.show', $person['id'])}}" class="text-lg hover:text-gray-300">{{$person['name']}}</a>
							<div class="text-sm truncate text-gray-400">{{$person['known_for']}}</div>
						</div>
					</div>

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
				<a href="/people/page/{{$previous}}">Previous</a>
			@else
				<div></div>
			@endif
			
			@if($next)
				<a class="infin-pag-next" href="/people/page/{{$next}}">Next</a>
			@else
				<div></div>
			@endif

		</div>
	</div>

@endsection

@section('scripts')

	
	<script>
		
		let elem = document.querySelector('.grid');
		let infScroll = new InfiniteScroll( elem, {
		  // options
		  path: '.infin-pag-next',
		  append: '.actor',
		  // history: false,
		  status: '.page-load-status',
		});


	</script>

@endsection