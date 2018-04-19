<style>
    body * {
        box-sizing: border-box;
    }

    body {
        background-color: #171121;
        overflow: hidden;
        width: 1920px;
        height: 1080px;
        border-right: 1px solid white;
        border-bottom: 1px solid white;
        margin: 0;
    }

    .positioning {
        position: absolute;
        top: 0;
        left: 0;
        width: 1920px;
        height: 1080px;
        overflow: hidden;
    }

    .brand {
        z-index: 200;
        position: absolute;
        top: 0;
        right: 0;
        width: 320px;
        height: 360px;
        background: white;
    }

    .brand img {
        max-width: 100%;
        height: auto;
    }

    .video {
        z-index: 110;
        position: absolute;
        top: 0;
        left: 0;
        width: 1600px;
        height: 900px;
        background-color: #333333;
        border-bottom: 3px solid #8135ff;
    }

    .now-playing {
        z-index: 50;
        position: absolute;
        top: 400px;
        right: 0;
        width: 320px;
        height: 500px;
        padding: 0 40px;
    }

    .now-playing-src {
        border: none;
        width: 100%;
        height: 100%;
        position: relative;
    }

    .widgets {
        z-index: 150;
        position: absolute;
        height: 180px;
        bottom: 0;
        left: 0;
        width: 1920px;
        overflow: hidden;
        font-size: 0;
    }

    .widgets .col {
        display: inline-block;
        width: 320px;
        height: 180px;
        text-align: center;
        vertical-align: top;
        line-height: 180px;
    }

    .widgets .col > * {
        display: inline-block;
    }

    .twitter {
        background: url(//cdn.joejiko.com/img/streaming/twitter.png) center center no-repeat;
    }

    .teamspeak {
        background: url(//cdn.joejiko.com/img/streaming/teamspeak.png) center center no-repeat;
    }

    .discord {
    }

    .discord-logo {
        padding: 39px 24px 10px;
    }

    .discord-link {
        width: 100%;
        height: 100%;
        color: white;
        font-size: 32px;
        line-height: 1
    }

    .no-video {
        background: url(//cdn.joejiko.com/img/streaming/no-video.png) center center no-repeat;
    }
</style>

<div class="positioning">
    <div class="brand">
        <img src="//cdn.joejiko.com/img/streaming/logo300sq.png">
    </div>
    <div class="video"></div>
    <div class="now-playing">
        {{--<img src="//cdn.joejiko.com/img/streaming/steam.png">--}}
        {{--<img src="//cdn.joejiko.com/img/streaming/switch.png">--}}
        <iframe class="now-playing-src" src="//local.joejiko.com/api/g/stream/template?uid=2&name=cover"></iframe>
    </div>
    <div class="widgets">
        <div class="col no-video"></div>
        <div class="col no-video"></div>
        <div class="col no-video"></div>
        <div class="col discord">
            <div class="discord-logo">
                <img class="discord-logo-img" src="//cdn.joejiko.com/img/streaming/Discord-Logo-White.png"
                     style="width: 80px; height: auto">
            </div>
            <div class="discord-link">jiko.us/ensdiscord</div>
        </div>
        <div class="col teamspeak" style="display:none"></div>
        <div class="col twitter"></div>
        <div class="col network" style="padding: 0 40px 20px; line-height: 1">
            @if($network = \Jiko\Gaming\Models\Network::where('platform_id', $platform->id)->where('default', 1)->first())
                <div style="background-color: {{ $platform->color ?: "transparent" }}; width: 100%; height: 100%;">
                    @if($userNetwork = \Jiko\Gaming\Models\UserNetwork::where('network_id', $network->id)->where('user_id', $game_user->id)->first())
                        <div style="position:relative; display: block; width: 100%; height: 128px;">
                            <div style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
                                <img style="max-width: 100%; height: auto" src="{{ $platform->logo }}"
                                     alt="{{ $network->name }}">
                            </div>
                        </div>
                        <div style="display: block; width: 100%; height: 32px; color: {{ $network->font_color ?: "#222222" }};font-size: 24px;font-family: 'Anonymous Pro', monospace;">
                            {{ $network->name }}: {{ $userNetwork->network_profile_id }}
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    function reload() {
        location.href = location.href;
    }

    // setInterval('reload()', 15000);
</script>