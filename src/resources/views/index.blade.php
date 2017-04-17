@section('modal.header')
    <h2><i class="fa fa-gamepad"></i> Let's play! Add me to your game networks</h2>
@stop
<section>
    @if(!request()->ajax())
        <h1><i class="fa fa-gamepad"></i> Gaming</h1>
        <article class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="row">
                        @if($TwitchStatus == "online")
                            <div class="col-md-10 alert alert-info">
                                <iframe src="https://player.twitch.tv/?channel={{getenv('TWITCH_USER_ID')}}"
                                        frameborder="0" allowfullscreen="true" scrolling="no" height="600"
                                        width="100%"></iframe>
                            </div>
                        @else
                            <div class="col-sm-12">
                                <h2 style="margin-left: 0; margin-top:0; color: #222222; position:relative; z-index: 50; height: 40px;line-height:1.5">
                                    Now
                                    Playing
                                </h2>
                                <div style="position:absolute;right:15px;top:5px;z-index:51"><a
                                            class="btn btn-default" href="/gaming/all-games"
                                            style="color: #171121">View all games</a></div>
                                <div style="background-color: #fefefe;padding: 0;margin-bottom: 20px">
                                    <div class="row">
                                        <div class="col-md-12" style="padding-left: 0; padding-right: 0;">
                                            <div style="position:relative;z-index: 45">
                                                <div style="background-color:#171121;opacity:.3;width:100%;height:100%;position:absolute;top:0;left:0;z-index:40"></div>
                                                @foreach($games_grouped as $row => $games)
                                                <?php
                                                $random = $games->shuffle()->first();
                                                ?>
                                                    <div class="row game-row"
                                                         style="background-color:#171121;background-image:url({{$random->image->get('screen_url')}});background-size:cover;background-position:center center;padding:15px;">
                                                        @foreach($games as $game)
                                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 game-col text-center"
                                                                 style="position:relative; z-index: 45; overflow:hidden; height:60px; display: table-cell">
                                                                <div class="platform-title"
                                                                     style="position:absolute;top:0;left:15px;background:#171121;padding: 3px 6px; color:#efefef; z-index:35">
                                                                    <div class="hidden-xs">{{ $game->platforms()->first()->name }}</div>
                                                                    <div class="visible-xs">{{ $game->platforms()->first()->abbreviation }}</div>
                                                                </div>
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 col-xs-6">
                                        <a href="{{ shorten("https://www.twitch.tv/jjiko") }}" target="_blank">
                                            <img src="http://s.jtvnw.net/jtv_user_pictures/hosted_images/Twitch_BlackLogo.png"
                                                 alt="Twitch"
                                                 style="max-width:100%;height:auto;margin-top:13%">
                                        </a>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-6">
                                        <a href="{{ shorten("https://gaming.youtube.com/c/Jikoi") }}" target="_blank">
                                            <img src="//cdn.joejiko.com/img/gaming/networks/logo-youtube.png"
                                                 alt="YouTube Gaming" style="max-width:100%;height:auto"></a>
                                    </div>
                                    <div class="col-md-6">
                                        <div style="margin-top:10%;">
                                            <h2 class="text-center" style="margin-top:0; color: grey">[Stream <span
                                                        style="color:#f00">offline</span>]
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </article>
    @endif
    @if(request()->ajax())
        @include('gaming::networks')
    @endif
</section>

@section('sidebars.content')
    @if(!request()->ajax())
        <div class="container">
            @include('gaming::networks')
        </div>
    @endif
@stop

@section('sidebars.tr')
    <div id="sidebars-4" style="height:50%">
        <div class="container">
            <div clas="col-md-12">
                Game chat
                <a href="ts3server://voice.errantnights.com&channel=Website Guest Entrance"><img
                            src="//cdn.joejiko.com/img/gaming/teamspeak-logo.svg"
                            style="max-width:100%;height:auto;"></a><br><br>
            </div>
            <div class="col-md-12 alert alert-info"
                 style="background-color:#9C27B0;text-align:center">
                <a href="http://jiko.us/1Py5gUD"><img
                            src="//cdn.joejiko.com/img/ens/errant-nights.svg"
                            style="max-width:100%;height:auto;"></a>
                <a href="http://jiko.us/1Py5gUD">Errant Nights gaming guild & Twitch streams<br>
                    <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    @include('gaming::activities')
@stop
@section('styles')
    <style>
        .game-img {
            cursor: pointer;
        }

        .game-img:hover {
            bottom: auto;
            top: 0;
        }
    </style>
    @parent
@stop