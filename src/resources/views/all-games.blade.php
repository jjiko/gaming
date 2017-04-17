@section('styles')
    @parent
    <style>
        .game-col:hover .game-img {
            bottom: auto;
            top: 0;
        }

        .games-list {
            padding-top: 15px;
        }

        .game-title {
            position: absolute;
            bottom: 15px;
            right: 15px;
            background: #8135FF;
            color: #efefef;
            z-index: 36;
            padding: 3px 6px;
        }

        .game-status {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 42px;
            background-repeat: no-repeat;
            z-index: 37;
            background-image: url(http://cdn.joejiko.com/img/gaming/status-sprite-2.png);
        }

        .game-status[data-status="Playing"] {
            background-position: 0 0;
        }

        .game-status[data-status="Backlog"] {
            background-position: 0 -42px;
        }

        .game-status[data-status="Completed"] {
            background-position: 0 -84px;
        }

        .game-status[data-status="Dropped"] {
            background-position: 0 -126px;
        }

        .game-status[data-status="Wishlist"] {
            background-position: 0 -168px;
        }

        .game-status[data-status="Playing"] span,
        .game-status[data-status="Backlog"] span,
        .game-status[data-status="Completed"] span,
        .game-status[data-status="Dropped"] span,
        .game-status[data-status="Wishlist"] span {
            display: none;
        }
    </style>
@stop
@foreach($wishlist as $status => $games)
    <h2>Wishlist/Pre-order</h2>
    <div class="row wishlist" style="position:relative; background-color: #000;">
        @include('gaming::gaming.game-item')
    </div>
@endforeach
@foreach($games_grouped as $platform => $games)
  <?php $platform_obj = \Jiko\Gaming\Models\Platform::where('name', $platform)->first(); ?>
  <h2>{{ $platform }}</h2>
  <div class="row games-list"
       style="position:relative; background-color: {{$platform_obj->color or 'transparent'}}">
      @include('gaming::gaming.game-item')
  </div>
@endforeach