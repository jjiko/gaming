@section('styles')
    @parent
    <style>
        .game-col:hover .game-img {
            bottom: auto;
            top: 0;
        }
    </style>
@stop
@foreach($games_grouped as $platform => $games)
    <h2>{{ $platform }}</h2>
    <div class="row" style="position:relative">
        @foreach($games as $game)
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 game-col text-center"
                 style="position:relative; z-index: 45; overflow:hidden; height:244px; display: table-cell">
                <div class="game-title"
                     style="position:absolute;bottom:15px;right:15px;background:#8135FF;color:#efefef;z-index:36;padding:3px 6px;">
                    {{ $game->name }}
                </div>
                <img data-game-id="{{ $game->id }}"
                     class="img-responsive img-fade-in game-img"
                     style="position:absolute;left:0;bottom:0;z-index:30;padding:15px"
                     alt="{{ $game->name }}"
                     src="{{ $game->image->get('small_url') }}">
            </div>
        @endforeach
    </div>
@endforeach