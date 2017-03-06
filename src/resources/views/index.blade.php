<section>
    <h1><i class="fa fa-gamepad"></i> Gaming</h1>
    @if(!request()->ajax())
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
                            <div class="col-sm-10">
                                <div class="alert alert-info" style="background:black">
                                    <div class="row">
                                        <div class="col-md-12"
                                             style="background-image: url('http://www.giantbomb.com/api/image/scale_medium/2920687-the%20legend%20of%20zelda%20-%20breath%20of%20the%20wild%20v7.jpg'); background-size: contain; min-height: 600px; background-position: bottom center; background-repeat: no-repeat">
                                            <h2 style="margin-top:0; text-shadow: 1px 1px rgba(0,0,0,1)">Now Playing: The Legend of
                                                Zelda: Breath of the Wild</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <img src="http://s.jtvnw.net/jtv_user_pictures/hosted_images/Twitch_BlackLogo.png"
                                             alt="Twitch"
                                             style="max-width:100%;height:auto;margin-top:13%">
                                    </div>
                                    <div class="col-md-3">
                                        <img src="//cdn.joejiko.com/img/gaming/networks/logo-youtube.png"
                                             alt="YouTube Gaming" style="max-width:100%;height:auto">
                                    </div>
                                    <div class="col-md-6">
                                        <div style="margin-top:10%;">
                                            <h2 class="" style="margin-top:0; color: grey">[Stream <span
                                                        style="color:#f00">offline</span>] <img
                                                        src="//cdn.joejiko.com/img/emoji/1f635.png"></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-2 pull-right">
                            <div class="row">
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
        @include('gaming::networks')
    @endif
@stop