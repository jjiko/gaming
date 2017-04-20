@foreach($games as $game)
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 game-col text-center"
         style="position:relative; z-index: 45; overflow:hidden; height:244px; display: table-cell">
        <div class="game-title">
            {{ $game->name }}
        </div>
        <div class="game-status" data-status="{{ $game->pivot->status }}">
            <span>{{ $game->pivot->status }}</span>
        </div>
        {{--<a href="{{ shorten("https://www.amazon.com/s/?field-keywords=".urlencode($game->name)) }}" target="_blank">--}}
        <img data-game-id="{{ $game->id }}"
             class="img-responsive img-fade-in game-img"
             style="position:absolute;left:0;bottom:0;z-index:30;padding:15px"
             alt="{{ $game->name }}"
             src="{{ $game->image->get('small_url') }}">
        {{--</a>--}}
    </div>
@endforeach