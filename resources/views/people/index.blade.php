@extends('layouts.main')

@section('content')
	<div class="container mx-auto px-4 py-16">
		<div class="popular-actors">
			<h2 class="uppercase tracking-wider text-yellow-500 text-lg font-semibold">Popular Actors</h2>

			<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">


				@foreach($popularPoeple as $person)

					<div class="actor mt-8">
						<a href="#">
							<img src="{{$person['profile_path']}}" alt="Main image" class="hover:opacity-75 transition ease-in-out duration-150">
						</a>
						<div class="mt-2">
							<a href="#" class="text-lg hover:text-gray-300">{{$person['name']}}</a>
							<div class="text-sm truncate text-gray-400">{{$person['known_for']}}</div>
						</div>
					</div>

				@endforeach

	
			</div>

		</div>

	</div>

@endsection