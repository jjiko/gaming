<!doctype html>
<style>
    body {
        height: 100%;
        width: 100%;
        margin: 0;
    }

    #platform {
        position: absolute;
        width: 100%;
        height: 20%;
        top: 0;
        background-image: url({{ $platform->image->small_url }});
        background-size: contain;
        background-repeat: no-repeat;
        z-index: 20;
    }

    #cover {
        background-image: url({{ $game->image->super_url }});
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        z-index: 10;
    }
</style>
<div id="platform"></div>
<div id="cover"></div>