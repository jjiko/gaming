@foreach($platforms as $platform)
    <h2>{{ $platform->name }}</h2>
    @foreach($platform->game as $game)
        <div class="col-md-4">
            <img class="img-responsive" src="{{ $game->image->get('thumb_url') }}" alt="{{ $game->name }}">
        </div>
    @endforeach
@endforeach