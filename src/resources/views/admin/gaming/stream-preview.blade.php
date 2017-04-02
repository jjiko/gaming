<!doctype html>
<html>
<head>
    <script src="/vendor/flowplayer/flowplayer/flowplayer-3.2.13.min.js"></script>
    <script src="https://use.fontawesome.com/0617c45fcc.js"></script>
</head>

<body>
<div id="player" style="width:1280px;height:720px;margin:0 auto;text-align:center"></div>
<div style="margin:0 auto; text-align:center;font-size:48px">
    <iframe style="border:0; width:100%; height:80px" src="/admin/gaming/stream-status"></iframe>
    <form method="post" action="/">
        <button type="submit" name="publish" value="publish">Go live</button>
    </form>
</div>
<script>
    var live_url = 'rtmp://local.joejiko.com/live/test';
    $f("player", "/vendor/flowplayer/flowplayer/flowplayer-3.2.18.swf", {
        clip: {
            url: live_url,
            live: true,
            provider: 'rtmp'
        },

        plugins: {
            rtmp: {
                url: "/vendor/flowplayer/flowplayer/flowplayer.rtmp-3.2.13.swf",

                netConnectionUrl: 'rtmp://local.joejiko.com'
            }
        },
        canvas: {
            backgroundGradient: 'none'
        }
    });

</script>
</body>
</html>