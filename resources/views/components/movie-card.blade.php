<div class="mt-8">
	<a href="{{ route('movies.show', $movie['id']) }}">
		<img src="{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="hover:opacity-75 transition ease-in-out duration-150">
	</a>
	<div class="mt-2">
		<a href="{{ route('movies.show', $movie['id']) }}" class="text-lg mt-2 hover:text-gray-300">{{ $movie['title'] }}</a>
		<div class="flex items-center text-gray-400 text-sm mt-1">
			<svg class="fill-current text-yellow-500 w-4" id="fi_2107957" enable-background="new 0 0 24 24" height="15" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m23.363 8.584-7.378-1.127-3.307-7.044c-.247-.526-1.11-.526-1.357 0l-3.306 7.044-7.378 1.127c-.606.093-.848.83-.423 1.265l5.36 5.494-1.267 7.767c-.101.617.558 1.08 1.103.777l6.59-3.642 6.59 3.643c.54.3 1.205-.154 1.103-.777l-1.267-7.767 5.36-5.494c.425-.436.182-1.173-.423-1.266z" fill="#ffc107"></path></svg>

			<span class="ml-1">{{ $movie['vote_average'] }}</span>
			<span class="mx-1">|</span>
			<span>{{ $movie['release_date'] }}</span>
		</div>
		<div class="text-gray-400 text-sm">{{ $movie['genres'] }}</div>
	</div>
</div>