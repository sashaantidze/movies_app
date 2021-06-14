<div class="relative mt-3 md:mt-0" x-data="{ isOpen: true, keyword: '' }" @click.away="isOpen = false">

	<input 
		wire:model.debounce.500ms="search" 
		type="text" 
		class="bg-gray-800 rounded-full w6 px-4 pl-8 py-1 focus:outline-none focus:shadow-outline text-sm"
		placeholder="Search"
		x-ref="search"
		@keydown.window="
			if(event.keyCode === 191){
				event.preventDefault();
				$refs.search.focus();
			}
		"
		@focus="isOpen = true" 
		@keydown="isOpen = true"
		@keydown.escape.window="isOpen = false"
		@keydown.shift.tab="isOpen = false"
		x-model="keyword"
	>

	<div class="absolute top-0">
		<svg class="fill-current text-gray-500 w-4 mt-2 ml-2" version="1.1" id="fi_149852" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve">
			<path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23
			s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92
			c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17
			s-17-7.626-17-17S14.61,6,23.984,6z"></path>
		</svg>
	</div>




<?xml version="1.0" encoding="utf-8"?>
<svg wire:loading class="search-svg-spinner top-0 right-0 bottom-0 mr-4 mt-3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: none; shape-rendering: auto; animation-play-state: running; animation-delay: 0s;" width="40px" height="40px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
<g transform="rotate(0 50 50)" style="animation-play-state: running; animation-delay: 0s;">
  <rect x="47" y="24.5" rx="3" ry="5.5" width="6" height="11" fill="#ffffff" style="animation-play-state: running; animation-delay: 0s;">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.9285714285714286s" repeatCount="indefinite" style="animation-play-state: running; animation-delay: 0s;"></animate>
  </rect>
</g><g transform="rotate(25.714285714285715 50 50)" style="animation-play-state: running; animation-delay: 0s;">
  <rect x="47" y="24.5" rx="3" ry="5.5" width="6" height="11" fill="#ffffff" style="animation-play-state: running; animation-delay: 0s;">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.8571428571428571s" repeatCount="indefinite" style="animation-play-state: running; animation-delay: 0s;"></animate>
  </rect>
</g><g transform="rotate(51.42857142857143 50 50)" style="animation-play-state: running; animation-delay: 0s;">
  <rect x="47" y="24.5" rx="3" ry="5.5" width="6" height="11" fill="#ffffff" style="animation-play-state: running; animation-delay: 0s;">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.7857142857142857s" repeatCount="indefinite" style="animation-play-state: running; animation-delay: 0s;"></animate>
  </rect>
</g><g transform="rotate(77.14285714285714 50 50)" style="animation-play-state: running; animation-delay: 0s;">
  <rect x="47" y="24.5" rx="3" ry="5.5" width="6" height="11" fill="#ffffff" style="animation-play-state: running; animation-delay: 0s;">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.7142857142857143s" repeatCount="indefinite" style="animation-play-state: running; animation-delay: 0s;"></animate>
  </rect>
</g><g transform="rotate(102.85714285714286 50 50)" style="animation-play-state: running; animation-delay: 0s;">
  <rect x="47" y="24.5" rx="3" ry="5.5" width="6" height="11" fill="#ffffff" style="animation-play-state: running; animation-delay: 0s;">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.6428571428571429s" repeatCount="indefinite" style="animation-play-state: running; animation-delay: 0s;"></animate>
  </rect>
</g><g transform="rotate(128.57142857142858 50 50)" style="animation-play-state: running; animation-delay: 0s;">
  <rect x="47" y="24.5" rx="3" ry="5.5" width="6" height="11" fill="#ffffff" style="animation-play-state: running; animation-delay: 0s;">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.5714285714285714s" repeatCount="indefinite" style="animation-play-state: running; animation-delay: 0s;"></animate>
  </rect>
</g><g transform="rotate(154.28571428571428 50 50)" style="animation-play-state: running; animation-delay: 0s;">
  <rect x="47" y="24.5" rx="3" ry="5.5" width="6" height="11" fill="#ffffff" style="animation-play-state: running; animation-delay: 0s;">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.5s" repeatCount="indefinite" style="animation-play-state: running; animation-delay: 0s;"></animate>
  </rect>
</g><g transform="rotate(180 50 50)" style="animation-play-state: running; animation-delay: 0s;">
  <rect x="47" y="24.5" rx="3" ry="5.5" width="6" height="11" fill="#ffffff" style="animation-play-state: running; animation-delay: 0s;">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.42857142857142855s" repeatCount="indefinite" style="animation-play-state: running; animation-delay: 0s;"></animate>
  </rect>
</g><g transform="rotate(205.71428571428572 50 50)" style="animation-play-state: running; animation-delay: 0s;">
  <rect x="47" y="24.5" rx="3" ry="5.5" width="6" height="11" fill="#ffffff" style="animation-play-state: running; animation-delay: 0s;">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.35714285714285715s" repeatCount="indefinite" style="animation-play-state: running; animation-delay: 0s;"></animate>
  </rect>
</g><g transform="rotate(231.42857142857142 50 50)" style="animation-play-state: running; animation-delay: 0s;">
  <rect x="47" y="24.5" rx="3" ry="5.5" width="6" height="11" fill="#ffffff" style="animation-play-state: running; animation-delay: 0s;">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.2857142857142857s" repeatCount="indefinite" style="animation-play-state: running; animation-delay: 0s;"></animate>
  </rect>
</g><g transform="rotate(257.14285714285717 50 50)" style="animation-play-state: running; animation-delay: 0s;">
  <rect x="47" y="24.5" rx="3" ry="5.5" width="6" height="11" fill="#ffffff" style="animation-play-state: running; animation-delay: 0s;">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.21428571428571427s" repeatCount="indefinite" style="animation-play-state: running; animation-delay: 0s;"></animate>
  </rect>
</g><g transform="rotate(282.85714285714283 50 50)" style="animation-play-state: running; animation-delay: 0s;">
  <rect x="47" y="24.5" rx="3" ry="5.5" width="6" height="11" fill="#ffffff" style="animation-play-state: running; animation-delay: 0s;">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.14285714285714285s" repeatCount="indefinite" style="animation-play-state: running; animation-delay: 0s;"></animate>
  </rect>
</g><g transform="rotate(308.57142857142856 50 50)" style="animation-play-state: running; animation-delay: 0s;">
  <rect x="47" y="24.5" rx="3" ry="5.5" width="6" height="11" fill="#ffffff" style="animation-play-state: running; animation-delay: 0s;">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.07142857142857142s" repeatCount="indefinite" style="animation-play-state: running; animation-delay: 0s;"></animate>
  </rect>
</g><g transform="rotate(334.2857142857143 50 50)" style="animation-play-state: running; animation-delay: 0s;">
  <rect x="47" y="24.5" rx="3" ry="5.5" width="6" height="11" fill="#ffffff" style="animation-play-state: running; animation-delay: 0s;">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="0s" repeatCount="indefinite" style="animation-play-state: running; animation-delay: 0s;"></animate>
  </rect>
</g>
<!-- [ldio] generated by https://loading.io/ --></svg>





	@if(strlen($search) > 2)

		<div class="z-50 absolute bg-gray-800 text-sm rounded w-64 mt-4" x-show.transition.opacity="isOpen">

			@if($searchResults->count() > 0)

				<ul>

					@foreach($searchResults as $movie)

						<li class="border-b border-gray-700">
							<a href="{{ route('movies.show', $movie['id']) }}" class="block hover:bg-gray-700 px-3 py-3 flex items-center" @if($loop->last) @keydown.tab="isOpen = false" @endif>
								@if($movie['poster_path'])
									<img class="w-8" src="{{config('services.tmdb.image_base_url')."/w92".$movie['poster_path']}}" alt="{{$movie['title']}}">
								@else
									<img src="https://via.placeholder.com/50x75" alt="No Poster" class="w-8">
								@endif
								<span class="ml-4">{{$movie['title']}}</span>
							</a>
						</li>
					@endforeach

					@if($seeAllButton) <div class="px-3 py-3 text-center"><a x-bind:href="'/movies/search/'+keyword">See All</a></div> @endif
				</ul>

			@else

				<div class="px-3 py-3">No results for "{{$search}}" </div>

			@endif


			
		</div>
	@endif

</div>