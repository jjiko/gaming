<section>
    <h1><i class="fa fa-gamepad"></i> Gaming</h1>
    <article class="row">
        <div class="col-md-12">
            <div class="">
                <div class="row">
                    @if($TwitchStatus == "online")
                        <div class="col-md-10 alert alert-info">
                            <style>
                                #live_embed_player_flash {
                                    width: 100%;
                                    height: 600px;
                                    position: relative;
                                    z-index: 0;
                                }
                            </style>
                            <object type="application/x-shockwave-flash" id="live_embed_player_flash"
                                    data="http://www.twitch.tv/widgets/live_embed_player.swf?channel=joejiko"
                                    bgcolor="#000000">
                                <param name="allowFullScreen" value="true"/>
                                <param name="allowScriptAccess" value="always"/>
                                <param name="allowNetworking" value="all"/>
                                <param name="movie" value="http://www.twitch.tv/widgets/live_embed_player.swf"/>
                                <param name="flashvars"
                                       value="hostname=www.twitch.tv&channel=joejiko&auto_play=true&start_volume=25"/>
                            </object>
                        </div>
                    @else
                        <div class="col-sm-10">
                            <div class="alert alert-info" style="background:black">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 style="margin-top:0">Now playing: No Man's Sky (PS4)</h2>
                                        <a href="https://jiko.us/2b6bC42">
                                            <img class="img-responsive"
                                                 src="//cdn.joejiko.com/img/gaming/nms.jpeg"
                                                 alt="No Man's Sky">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="http://s.jtvnw.net/jtv_user_pictures/hosted_images/Twitch_BlackLogo.png"
                                         alt="Twitch"
                                         style="max-width:100%;height:auto">
                                </div>
                                <div class="col-md-6">
                                    <h2 class="" style="margin-top:0; color: grey">[Stream <span
                                                style="color:#f00">offline</span>] <img
                                                src="//cdn.joejiko.com/img/emoji/1f635.png"></h2>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-2 pull-right">
                        <div class="row">
                            <div clas="col-md-12">
                                Game chat
                                <a href="ts3server://voice.errantnights.com&channel=Website Guest Entrance"><img src="//cdn.joejiko.com/img/gaming/teamspeak-logo.svg" style="max-width:100%;height:auto;"></a><br><br>
                            </div>
                            <div class="col-md-12 alert alert-info" style="background-color:#9C27B0;text-align:center">
                                <a href="http://jiko.us/1Py5gUD"><img src="//cdn.joejiko.com/img/ens/errant-nights.svg"
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
    <article class="row">
        <div class="col-md-12">
            <h2>Let's play!</h2>

            <p>Add me to your game networks</p>

            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th>Service</th>
                        <th>Username/Friend code</th>
                    </tr>
                    <tr>
                        <td>
                            <img class="img-responsive" alt="Steam"
                                 src="http://store.akamai.steamstatic.com/public/images/v5/globalheader_logo.png">
                        </td>
                        <td>
                            <a href="http://jiko.us/163Su8E" target="_blank">JoeJiko</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img class="img-responsive" style="max-height:80px" src="https://media.playstation.com/is/image/SCEA/playstation-logo-imageblock-us-10mar15?$TwoColumn_Image$">
                        </td>
                        <td>
                            <a href="http://jiko.us/1ov8G1I" target="_blank">joejiko</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img class="img-responsive" alt="Nintendo Wii U"
                                 src="https://www.nintendo.com/images/page/wiiu/common/logo-wiiu.png"
                                 style="display:inline-block">
                            <img class="img-responsive" alt="Nintendo Wii U Network ID"
                                 src="https://www.nintendo.com/images/page/3ds/nintendo-network-id/logo-nn.png"
                                 style="display:inline-block">
                        </td>
                        <td><a target="_blank" href="<?php echo shorten("https://miiverse.nintendo.net/users/jjcoms"); ?>">jjcoms</a></td>
                    </tr>
                    <tr>
                        <td>
                            <img class="img-responsive" alt="Nintendo 3DS"
                                 src="https://www.nintendo.com/images/page/3ds/common/logo-3ds.png">
                        </td>
                        <td>1950 - 8211 - 2435<br>
                            (<a href="<?php echo shorten('https://twitter.com/intent/tweet?in_reply_to=682417600693977089&text='.urlencode('my 3ds friend code is ').'&related=joejiko,jjcoms&original_referer=https://www.joejiko.com/gaming') ?>">tweet me your friend
                                code)</a></td>
                    </tr>
                    <tr>
                        <td>
                            <a href="<?php echo shorten('http://us.battle.net/en/') ?>" target="_blank">
                                <img alt="battle.net" class="img-responsive"
                                     src="http://us.battle.net/static/local-common/images/logos/bnet-default.png">
                            </a>
                        </td>
                        <td>
                            JoeJiko#1267 (battletag)
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="https://www.origin.com/en-us/store/">
                                <img alt="Origin" class="img-responsive"
                                     src="https://eaassets-a.akamaihd.net/origin-com-store-damassets/content/dam/OriginAsset/header-logo.png">
                            </a>
                        </td>
                        <td>
                            joejiko
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <h2>Current playlist</h2>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <h3><abbr title="New Nintendo 3DS">N3DS</abbr></h3>
                        </div>
                        <div class="col-md-12">
                            <a href="/monsterhunter">
                                <img src="{!! img_path('img/gaming/mhgen.jpg') !!}" class="img-responsive">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>PC</h3>
                        </div>
                        <div class="col-md-12"></div>
                    </div>
                </div>
            </div>
        </div>
    </article>
</section>

@section('sidebars.content')

@stop