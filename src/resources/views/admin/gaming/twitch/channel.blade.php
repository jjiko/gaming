<h1>{{ $channel->name }} (on <a href="{{ $channel->url }}" target="_blank">Twitch</a>)</h1>
<div class="row" style="background-image:url({{ $channel->profile_banner }});background-repeat:no-repeat;background-size:cover;">
    <div class="col-md-4">
        <a href="{{ $channel->url }}" target="_blank">
            <img class="img-responsive" src="{{ $channel->logo }}" alt="">
        </a>
    </div>
    <div class="col-md-8" style="background:rgba(255,255,255,.9);padding-top:15px;padding-bottom:15px;">
        <p>
            Stream key<br>
            <small data-stream-key="{{ $channel->stream_key }}">{{ $channel->stream_key_hidden() }}</small>
            <br><br>
            {{ $channel->email }}<br><br>

            followers: {{ $channel->followers }}
            views: {{ $channel->views }}
        </p>
        <form>
            <div class="form-group">
                <label>Playing</label>
                <input list="games" class="form-control" type="text" name="game" value="{{ $channel->game }}">
            </div>
            <div class="form-group">
                <label>Stream title (status)</label>
                <input class="form-control" type="text" name="status" value="{{ $channel->status }}">
            </div>
            <button class="btn btn-warning">Update channel</button>
        </form>
    </div>
</div>