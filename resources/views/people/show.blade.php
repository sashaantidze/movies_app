@extends('layouts.main')

@section('page_title'){{$person['name']}} - @endsection

@section('liveweire-search-component')
	<livewire:search-dropdown :controller="$controllerName">
@endsection

@section('content')

	<div class="movie-info border-b border-gray-800">
		<div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
			

			<div class="flex-none">
				<img src="{{$person['profile_path']}}" alt="" class="w-76">
				<ul class="flex items-center mt-4">
					@if($person['homepage'])
					<li class="ml-6">
						<a target="_blank" href="{{$person['homepage']}}" title="Actor Homepage">Hp</a>
					</li>
					@endif

					@if($social['facebook'])
					<li class="ml-6">
						<a target="_blank" href="{{$social['facebook']}}">Fb</a>
					</li>
					@endif

					@if($social['twitter'])
					<li class="ml-6">
						<a target="_blank" href="{{$social['twitter']}}">Twit</a>
					</li>
					@endif

					@if($social['instagram'])
					<li class="ml-6">
						<a target="_blank" href="{{$social['instagram']}}">Insta</a>
					</li>
					@endif

				</ul>
			</div>

			

			<div class="md:ml-24">
				<h2 class="text-4xl font-semibold">{{$person['name']}}</h2>
				<div class="flex flex-wrap items-center text-gray-400 text-sm mt-1">
					<svg id="Capa_1" enable-background="new 0 0 512 512" height="24" viewBox="0 0 512 512" width="24" xmlns="http://www.w3.org/2000/svg"><g id="XMLID_503_"><g id="XMLID_1206_"><g id="XMLID_1212_"><path id="XMLID_1213_" d="m256 159c-8.284 0-15-6.716-15-15v-29.748c0-8.284 6.716-15 15-15s15 6.716 15 15v29.748c0 8.284-6.715 15-15 15z" fill="#5f69e2"/></g></g><g id="XMLID_1180_"><g id="XMLID_1181_"><path id="XMLID_1183_" d="m456.055 285.088h-400.11c-8.284 0-15 6.716-15 15v175.565c0 8.284 6.716 15 15 15h400.109c8.284 0 15-6.716 15-15v-175.565c.001-8.284-6.715-15-14.999-15z" fill="#ffe377"/><g id="XMLID_970_"><path id="XMLID_1182_" d="m456.055 285.088h-200.055v205.565h200.055c8.284 0 15-6.716 15-15v-175.565c0-8.285-6.716-15-15-15z" fill="#fc0"/></g></g></g><g id="XMLID_1141_"><g id="XMLID_1167_"><path id="XMLID_1170_" d="m135.169 159c-8.284 0-15-6.716-15-15v-29.748c0-8.284 6.716-15 15-15s15 6.716 15 15v29.748c0 8.284-6.715 15-15 15z" fill="#5f69e2"/></g><g id="XMLID_1154_"><g id="XMLID_1163_"><g id="XMLID_1164_"><path id="XMLID_1166_" d="m376.831 159c-8.284 0-15-6.716-15-15v-29.748c0-8.284 6.716-15 15-15s15 6.716 15 15v29.748c0 8.284-6.716 15-15 15z" fill="#3440da"/></g></g><g id="XMLID_1161_"><path id="XMLID_1162_" d="m401.857 38.064c-6.841-12.735-13.583-23.445-13.867-23.895-2.416-3.831-6.63-6.155-11.159-6.155s-8.743 2.324-11.159 6.155c-.284.45-7.026 11.16-13.867 23.895-13.272 24.707-14.973 34.596-14.973 40.451 0 22.061 17.944 40.009 40 40.009s40-17.948 40-40.009c-.001-5.856-1.703-15.744-14.975-40.451z" fill="#fc0"/></g></g></g><g id="XMLID_518_"><path id="XMLID_1140_" d="m256.001 99.252-.001 59.748c8.284 0 15-6.716 15-15v-29.748c.001-8.284-6.715-15-14.999-15z" fill="#3440da"/></g><path id="XMLID_1139_" d="m267.16 14.168c-2.416-3.831-6.63-6.155-11.159-6.155-4.53 0-8.743 2.324-11.159 6.155-.284.45-7.026 11.16-13.867 23.895-13.272 24.707-14.973 34.596-14.973 40.451 0 22.061 17.944 40.009 40 40.009s40-17.948 40-40.009c0-5.855-1.702-15.744-14.973-40.451-6.843-12.734-13.585-23.445-13.869-23.895z" fill="#ffe377"/><g id="XMLID_969_"><path id="XMLID_1136_" d="m281.027 38.064c-6.841-12.735-13.583-23.445-13.867-23.895-2.416-3.831-6.63-6.155-11.159-6.155v110.51c22.056 0 40-17.948 40-40.009-.001-5.856-1.702-15.744-14.974-40.451z" fill="#fc0"/></g><g id="XMLID_1130_"><g id="XMLID_1132_"><g id="XMLID_1133_"><path id="XMLID_1135_" d="m497 503.987h-482c-8.284 0-15-6.716-15-15s6.716-15 15-15h482c8.284 0 15 6.716 15 15s-6.716 15-15 15z" fill="#e5e5e5"/></g></g></g><g id="XMLID_966_"><path id="XMLID_1103_" d="m497 473.987h-241v30h241c8.284 0 15-6.716 15-15s-6.716-15-15-15z" fill="#d6d6d6"/></g><path id="XMLID_1085_" d="m277.714 142.825h-43.427c-10.099 0-18.286 8.187-18.286 18.286v115.854c0 10.099 8.187 18.286 18.286 18.286h43.427c10.099 0 18.286-8.187 18.286-18.286v-115.854c0-10.099-8.187-18.286-18.286-18.286z" fill="#989eec"/><g id="XMLID_1072_"><path id="XMLID_1084_" d="m156.883 142.825h-43.427c-10.099 0-18.286 8.187-18.286 18.286v115.854c0 10.099 8.187 18.286 18.286 18.286h43.427c10.099 0 18.286-8.187 18.286-18.286v-115.854c0-10.099-8.187-18.286-18.286-18.286z" fill="#989eec"/><path id="XMLID_1074_" d="m398.544 142.825h-43.427c-10.099 0-18.286 8.187-18.286 18.286v115.854c0 10.099 8.187 18.286 18.286 18.286h43.427c10.099 0 18.286-8.187 18.286-18.286v-115.854c.001-10.099-8.187-18.286-18.286-18.286z" fill="#7c83e7"/></g><g id="XMLID_965_"><path id="XMLID_1070_" d="m277.713 142.825h-21.713v152.427h21.713c10.1 0 18.287-8.187 18.287-18.287v-115.854c0-10.099-8.187-18.286-18.287-18.286z" fill="#7c83e7"/></g><path id="XMLID_1069_" d="m441.688 256.33h-371.375c-23.075 0-41.849 17.143-41.849 38.214v38.672c0 10.518 5.068 20.334 13.904 26.935 9.994 7.464 23.29 9.751 35.565 6.115l37.866-11.21c21.882-6.477 45.984-6.476 67.864 0l29.889 8.848c13.688 4.053 28.065 6.078 42.447 6.078 14.379-.001 28.763-2.026 42.447-6.078l29.889-8.848c21.882-6.479 45.982-6.477 67.864 0l37.866 11.21c12.275 3.633 25.572 1.347 35.564-6.115 8.837-6.601 13.904-16.417 13.904-26.935v-38.672c.003-21.071-18.77-38.214-41.845-38.214z" fill="#ffa1c0"/><g id="XMLID_302_"><path id="XMLID_1060_" d="m441.688 256.33h-185.688v113.651c14.379-.001 28.763-2.026 42.447-6.078l29.889-8.848c21.882-6.479 45.982-6.477 67.864 0l37.866 11.21c12.275 3.633 25.572 1.347 35.564-6.115 8.837-6.601 13.904-16.417 13.904-26.935v-38.672c.002-21.07-18.771-38.213-41.846-38.213z" fill="#ff80a9"/></g><path id="XMLID_1059_" d="m146.329 14.168c-2.416-3.831-6.63-6.155-11.159-6.155s-8.743 2.324-11.159 6.155c-.284.45-7.026 11.16-13.867 23.895-13.273 24.708-14.975 34.596-14.975 40.452 0 22.061 17.944 40.009 40 40.009s40-17.948 40-40.009c0-5.855-1.702-15.744-14.973-40.451-6.841-12.735-13.583-23.446-13.867-23.896z" fill="#ffe377"/></g></svg>

					<span class="ml-2">{{$person['birthday']}} ({{$person['age'] }} Years old)</span>
					<span class="mx-1">|</span>
					{{$person['place_of_birth']}}


				</div>

				<p class="text-gray-300 mt-8">{{$person['biography']}}</p>

				<h4 class="font-semibold mt-12">Known for</h4>

				<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8">
					@foreach($knownFor as $movie)
					<div class="mt-4">
						<a href="{{$movie['movie_tv_link']}}">
							<img src="{{$movie['poster_path']}}" alt="poster" title="{{$movie['title']}}" class="hover:opacity-75 transition ease-in-out duration-150">
						</a>
						<a href="{{$movie['movie_tv_link']}}" class="text-sm leading-normal block text-gray-400 hover:text-white mt-1">{{$movie['title']}}</a>
					</div>

					@endforeach

					
				</div>

				{{-- <div class="flex justify-end">
					<a href="" class="flex justify-evenly">
						<span>See all</span> 
						<span>
							<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
							  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
							</svg>
						</span>
								
					</a>
				</div> --}}
				<div class="flex justify-end mt-2">
					<a target="_blank" href="{{route('movies.person', ['person' => $person['id'], 'name' => $person['name']])}}" class="inline-flex items-center mr-5 px-3 text-sm py-2 font-medium rounded px-4 py-2 leading-5 bg-indigo-500 text-primary-100 transition ease-in-out duration-150 text-white hover:text-white hover:bg-indigo-800">
					    See All Movies &nbsp;&nbsp; <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
						  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
						</svg>
					</a>

					<a target="_blank" href="{{route('tv.person', ['person' => $person['id'], 'name' => $person['name']])}}" class="inline-flex items-center px-3 text-sm py-2 font-medium rounded px-4 py-2 leading-5 bg-indigo-700 text-primary-100 transition ease-in-out duration-150 text-white hover:text-white hover:bg-indigo-800">
					    See All TV Shows &nbsp;&nbsp; <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
						  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
						</svg>
					</a>
				</div>
				


			</div>
		</div>
	</div>


	<div class="credits border-b border-gray-800">
		<div class="container mx-auto px-4 py-16">
			<h2 class="text-4xl font-semibold">Credits</h2>
			<ul class="list-disc leading-loose pl-5 mt-8">
				@foreach($credits as $cred)
					<li>{{$cred['release_year']}} &middot; <strong><a href="{{route('movies.show', $cred['id'])}}">{{$cred['title']}}</a></strong> as {{$cred['character']}}</li>
				@endforeach
			</ul>
		</div>
	</div>


@endsection