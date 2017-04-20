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
            font-size: 24px;
        }

        .game-status {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 42px;
            background-repeat: no-repeat;
            z-index: 37;
            /*background-image: url(http://cdn.joejiko.com/img/gaming/status-sprite-2.png);*/
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

<?php
$random = $games->shuffle()->first();
?>
<div class="row game-row"
     style="background-color:#171121;background-image:url({{$random->image->get('screen_url')}});background-size:cover;background-position:center center;padding:15px;position:relative;">
    @include('gaming::gaming.game-item')
</div>