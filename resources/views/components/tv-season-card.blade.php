<div class="movie mt-8">
    <a href="{{route('tv.season', ['tv'=>$season['parent_tvshow_id'], 'season'=>$season['season_number']])}}">
        <img src="{{ $season['poster_path'] }}" alt="{{ $season['name'] }}" class="hover:opacity-75 transition ease-in-out duration-150">
    </a>
    <div class="mt-2">
        <a href="{{route('tv.season', ['tv'=>$season['parent_tvshow_id'], 'season'=>$season['season_number']])}}" class="text-lg mt-2 hover:text-gray-300">{{ $season['name'] }} - {{$season['episode_count']}} Episodes</a>
        <div class="flex items-center text-gray-400 text-sm mt-1">
            <span>First Air Date: {{ $season['air_date'] }}</span>
        </div>

    </div>
</div>