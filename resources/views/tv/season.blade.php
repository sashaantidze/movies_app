@extends('layouts.main')

@section('page_title') {{$season['name']}} - @endsection

@section('content')

	<div class="tvshow-info border-b border-gray-800">
		<div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">


			<div class="flex-none">
				<img src="{{$season['poster_path']}}" alt="{{ $season['name'] }}" class="w-64 md:w-96">
			</div>

			




			<div class="md:ml-24">
				<h2 class="text-4xl font-semibold">{{ $season['name'] }}</h2>
				<div class="flex flex-wrap items-center text-gray-400 text-sm mt-1">
					
					<span class="mx-1">|</span>
					<span class="mx-1">First Air Date: <span class="font-medium text-white">{{ $season['air_date'] }}</span></span>
					<span class="mx-1">|</span>
				</div>

				<p class="text-gray-300 mt-8">{{ $season['overview'] }}</p>


				<div x-data="{ isOpen: false, embedSrc: '' }">
					
					@if (count($season['videos']['results']) > 0)
						<div class="mt-12">
							<button
							@click="
								isOpen = true
								embedSrc = 'https://www.youtube.com/embed/{{$season['videos']['results'][0]['key']}}'
								" 
							 href="https://youtube.com/watch?v={{$season['videos']['results'][0]['key']}}" target="_blank" class="flex inline-flex items-center bg-yellow-500 text-gray-900 rounded semibold px-5 py-4 hover:bg-yellow-600 transition ease-in-out duration-150">
								<svg class="w-6 fill-current" version="1.1" id="fi_27223" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20" height="20" viewBox="0 0 163.861 163.861" style="enable-background:new 0 0 163.861 163.861;" xml:space="preserve">

									<path d="M34.857,3.613C20.084-4.861,8.107,2.081,8.107,19.106v125.637c0,17.042,11.977,23.975,26.75,15.509L144.67,97.275
										c14.778-8.477,14.778-22.211,0-30.686L34.857,3.613z"></path>

								</svg>
								<span class="ml-2">Play Trailer</span>
							</button>
						</div>
					@endif

					<x-season-trailer-modal :season=$season/>

				</div>



				<h4 class="font-semibold mt-12">Episodes</h4>
				<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8">
					@foreach($season['episodes'] as $episode)
					<div class="mt-4">
						<a href="{{$episode['id']}}">
							<img src="{{$episode['still_path']}}" alt="poster" title="{{$episode['name']}}" class="hover:opacity-75 transition ease-in-out duration-150">
						</a>
						<a href="{{$episode['id']}}" class="text-sm leading-normal block text-gray-400 hover:text-white mt-1">{{$episode['name']}}</a>
					</div>

					@endforeach

					
				</div>

			</div>






		</div>
	</div>




	<div class="tvshow-cast border-b border-gray-800">
		<div class="container mx-auto px-4 py-16">
			<h2 class="text-4xl font-semibold">Cast</h2>
			<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">
				@foreach($season['cast'] as $cast)
					<div class="mt-8">
						<a href="{{route('people.show', $cast['id'])}}">
							@if($cast['profile_path'])
								<img src="{{config('services.tmdb.image_base_url')."w500".$cast['profile_path']}}" alt="{{ $cast['name'] }}" class="hover:opacity-75 transition ease-in-out duration-150">
							@else <img src="{{asset('img/no-photo-1.jpg')}}" alt="Photo unavailable" class="hover:opacity-75 transition ease-in-out duration-150">
							@endif
						</a>
						<div class="mt-2">
							<a href="{{route('people.show', $cast['id'])}}" class="text-lg mt-2 hover:text-gray-300">{{ $cast['name'] }}</a>
							
							<div class="text-gray-400 text-sm">
								{{ $cast['character'] }}
							</div>
						</div>
					</div>
				@endforeach

				
			</div>
		</div>
	</div>



	<div x-data="{ imageOpen: false, image: '' }">
		
		<div class="tvshow-gallery border-b border-gray-800">
			<div class="container mx-auto px-4 py-16">
				<h2 class="text-4xl font-semibold">Gallery</h2>
				<div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-16">

					@foreach($season['images'] as $image)
							<div class="mt-8">
								<a href="#" 
								@click.prevent="
									imageOpen = true
									image = '{{config('services.tmdb.image_base_url')."/original".$image['file_path']}}'
									"
								>
									<img src="{{config('services.tmdb.image_base_url')."/w500".$image['file_path']}}" alt="{{ $image['aspect_ratio'] }}" class="hover:opacity-75 transition ease-in-out duration-150">
								</a>
								
							</div>
					@endforeach
					<x-tvshow-image-modal/>
					
				</div>
			</div>
		</div>

	</div>

@endsection