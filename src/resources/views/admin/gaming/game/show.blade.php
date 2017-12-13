<h1 data-game-id="{{$game->id}}">{{ $game->name }}</h1>
@foreach($game->platforms as $platform)
    <h2 data-platform-id="{{ $platform->id }}">{{ $platform->name }}</h2>
@endforeach
Giantbomb: {{ $game->gbid }}<br>
<div style="height:600px;overflow-y: hidden; overflow-x:auto">
    @foreach($game->image as $i => $image)
        <img data-image-key="{{ $i }}" src="{{ $image }}" style="max-height: 600px">
    @endforeach
</div>

<button class="btn btn-default">Crop cover</button>
<button class="btn btn-default">Set cover (URL)</button>
<button class="btn btn-default">Upload cover</button>