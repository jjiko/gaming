<ul>
    <li>{{ $game->id }} {{ $game->name }}</li>
    @foreach($game->platforms as $platform)
        <li>{{ $platform->id }} {{ $platform->name }}</li>
    @endforeach
    <li>Giantbomb: {{ $game->gbid }}</li>
</ul>