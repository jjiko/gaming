<!doctype html>
<link href="https://fonts.googleapis.com/css?family=Anonymous+Pro" rel="stylesheet">
<style>
    body {
        height: 100%;
        width: 100%;
        margin: 0;
        font-family: 'Anonymous Pro', monospace;
    }

    #platform {
        position: absolute;
        width: auto;
        height: 10vh;
        top: 0;
        z-index: 20;
        font-size: 10vh;
        background-color: #171121;
        padding: 0 3vw;
        line-height: 1;
        color: #efefef;
    }

    #cover {
        background-image: url({{ $game->image->get('super_url') }});
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
<div id="platform">{{ $platform->abbreviation }}</div>
<div id="cover"></div>