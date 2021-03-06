@extends('layouts.main')

@section('page_title'){{$movie['title']}} - @endsection

@section('liveweire-search-component')
	<livewire:search-dropdown :controller="$controllerName">
@endsection

@section('content')

@if ($stat = Session::get('tmdb_session_status'))

	<script>
		Swal.fire({
		  position: 'bottom-start',
		  icon: '{{ $stat['status'] }}',
		  title: '{{ $stat['msg'] }}',
		  text: '{{ $stat['sub_msg'] }}',
		  showConfirmButton: true,
		})
	</script>	
        
@endif

	<div class="movie-info border-b border-gray-800">
		<div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
			<img src="{{$movie['poster_path']}}" alt="{{ $movie['title'] }}" class="w-64 md:w-96">
			<div class="md:ml-24">
				<h2 class="text-4xl font-semibold">{{ $movie['title'] }}</h2>
				<div class="flex flex-wrap items-center text-gray-400 text-sm mt-1">
					<svg class="fill-current text-yellow-500 w-4" id="fi_2107957" enable-background="new 0 0 24 24" height="15" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m23.363 8.584-7.378-1.127-3.307-7.044c-.247-.526-1.11-.526-1.357 0l-3.306 7.044-7.378 1.127c-.606.093-.848.83-.423 1.265l5.36 5.494-1.267 7.767c-.101.617.558 1.08 1.103.777l6.59-3.642 6.59 3.643c.54.3 1.205-.154 1.103-.777l-1.267-7.767 5.36-5.494c.425-.436.182-1.173-.423-1.266z" fill="#ffc107"></path></svg>

					<span class="ml-1">{{ $movie['vote_average']}}</span>
					<span class="mx-1">|</span>
					{{ $movie['release_date'] }}
					<span class="mx-1">|</span>
					<span class="mx-1">{{$movie['genres']}}</span>
				</div>

				<p class="text-gray-300 mt-8">{{ $movie['overview'] }}</p>

				<div class="mt-12">
					<h4 class="text-white font-semibold">Featured Crew</h4>
					<div class="flex mt-4">
						@foreach ($movie['crew'] as $crew)
								<div class="mr-8">
									<div>{{ $crew['name'] }}</div>
									<div class="text-sm text-gray-400">{{ $crew['job'] }}</div>
								</div>
						@endforeach

						

					</div>
				</div>


				<div x-data="{ isOpen: false, embedSrc: '' }">
					
					@if (count($movie['videos']['results']) > 0)
						<div class="mt-12">
							<button
							@click="
								isOpen = true
								embedSrc = 'https://www.youtube.com/embed/{{$movie['videos']['results'][0]['key']}}'
								" 
							 href="https://youtube.com/watch?v={{$movie['videos']['results'][0]['key']}}" target="_blank" class="flex inline-flex items-center bg-yellow-500 text-gray-900 rounded semibold px-5 py-4 hover:bg-yellow-600 transition ease-in-out duration-150">
								<svg class="w-6 fill-current" version="1.1" id="fi_27223" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20" height="20" viewBox="0 0 163.861 163.861" style="enable-background:new 0 0 163.861 163.861;" xml:space="preserve">

									<path d="M34.857,3.613C20.084-4.861,8.107,2.081,8.107,19.106v125.637c0,17.042,11.977,23.975,26.75,15.509L144.67,97.275
										c14.778-8.477,14.778-22.211,0-30.686L34.857,3.613z"></path>

								</svg>
								<span class="ml-2">Play Trailer</span>
							</button>
						</div>
					@endif

					<x-movie-trailer-modal :movie=$movie/>

				</div>

				


				


				<div class="ratings mt-8" x-data="func()">

					<fieldset class="rating">
					
						@for($i = 10; $i >= 1; $i--)
							<input @click="showMess($event)" type="radio" data-rate="{{$i}}" id="star_{{$i}}" name="rating" value="{{$i}}" /><label class = "full" for="star_{{$i}}"></label>
						@endfor

					</fieldset>
				</div>

				<script>
					function func(){
						return {
							showMess(e) {
								fetch('/movies/rating/' + e.target.dataset.rate +'/{{$movie['id']}}', {
									method: 'GET',
									headers: {
										'Content-Type': 'application/json',
									},
								}).then(function(response){
									if(response.status === 200){
										response.json().then(function(data) {
											Swal.fire(
											  data.msg,
											  data.sub_msg,
											  data.status
											)
									        console.log(data);
									      });
									}
								});
							}
						}
					}
				</script>


			</div>
		</div>
	</div>


	<div class="movie-cast border-b border-gray-800">
		<div class="container mx-auto px-4 py-16">
			<h2 class="text-4xl font-semibold">Cast</h2>
			<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">
				@foreach($movie['cast'] as $cast)
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


	@if(count($similarMovies))
		<div class="movie-similars border-b border-gray-800">
			<div class="container mx-auto px-4 py-16">

				<div class="section-title flex justify-start">
					<h2 class="text-4xl font-semibold mr-4">Similar Movies</h2>
					<a target="_blank" href="{{route('movies.similar', $movie['id'])}}" class="inline-flex items-center px-3 py-2 font-medium rounded leading-5 transition ease-in-out duration-150 text-white hover:text-white hover:bg-indigo-800">
						    See More &nbsp;&nbsp; <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
							  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
							</svg>
						</a>
				</div>

				<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">

					@foreach($similarMovies->take(5) as $simMovie)
						<x-movie-card :movie=$simMovie/>
					@endforeach
					
				</div>
			</div>
		</div>
	@endif


	@if(count($recommendations))
		<div class="movie-recomms border-b border-gray-800">
			<div class="container mx-auto px-4 py-16">
				<div class="section-title flex justify-start">
					<h2 class="text-4xl font-semibold mr-4">Recommended Movies</h2>
					<a target="_blank" href="{{route('movies.recommendation', $movie['id'])}}" class="inline-flex items-center px-3 py-2 font-medium rounded leading-5 transition ease-in-out duration-150 text-white hover:text-white hover:bg-indigo-800">
						    See More &nbsp;&nbsp; <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
							  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
							</svg>
						</a>
				</div>
				
				<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">

					@foreach($recommendations->take(5) as $recMovie)
						<x-movie-card :movie=$recMovie/>
					@endforeach
					
				</div>
			</div>
		</div>
	@endif



	<div x-data="{ imageOpen: false, image: '' }">
		
		<div class="movie-gallery border-b border-gray-800">
			<div class="container mx-auto px-4 py-16">
				<h2 class="text-4xl font-semibold">Gallery</h2>
				<div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-16">

					@foreach($movie['images'] as $image)
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
					<x-movie-image-modal/>
					
				</div>
			</div>
		</div>

	</div>

@endsection

