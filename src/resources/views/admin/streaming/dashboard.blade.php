<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills">
            <li role="presentation"><a href="#"><strong>Dashboard</strong></a></li>
            <li role="presentation"><a href="#">Titles</a></li>
            <li role="presentation"><a href="#">Social alerts</a></li>
            <li role="presentation"><a href="#">Stream history</a></li>
            <li role="presentation"><a href="#">Chat</a></li>
        </ul>
    </div>
</div>
{{-- var_dump($stream) --}}
<div class="row">
    <div class="col-md-8">
        <h2>Channels
            <div class="pull-right">
                <button class="btn btn-default">+ Add channel</button>
            </div>
        </h2>
        @if(count($channels))
            @foreach($channels as $channel)
          <?php
          $match = $stream->accounts->search(function ($item, $key) use ($channel) {
            return $item->network == $channel->network;
          });
          ?>
                <label><input type="checkbox" <?php if ($match !== false) echo "checked"; ?>>
                    #{{ $channel->network }} {{ $channel->name }} /{{ $channel->slug }}
                    (online|offline)</label><br>
            @endforeach
        @else
            Add a channel to begin
        @endif
        @foreach($keystore as $accounts)
            <h5>{{ array_get($accounts, 'account_network') }}</h5>
            <table class="table">
                @foreach(array_get($accounts, 'keystore') as $keystore)
                    <tr>
                        <td>{{ $keystore->key }}</td>
                        <td>{{ $keystore->value }}</td>
                    </tr>
                @endforeach
            </table>
        @endforeach
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
                <video controls
                       poster="{{ vsprintf("%s:%s", [$ms_config->public_http_url, $ms_config->http_listen]) }}/static/img/novideo.jpg"
                       id="preview"
                       style="max-width:100%" data-stream-id="{{ $stream->id }}"
                       data-preview-required="{{ $stream->preview_required }}"></video>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row" style="margin-top:10px; margin-bottom: 10px;">
                    <div class="col-md-8">
                        <label><input type="checkbox"
                                      name="isPreviewRequired" <?php if ($stream->preview_required) echo "checked"; ?>>
                            Preview required</label>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-success">Go Live</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="rtmpurl">RTMP URL </label>
                        <div class="pull-right"><a href="#">#SpeedTest</a></div>
                        <input class="form-control" name="rtmpurl" id="rtmpurl"
                               value="{{ $ms_config->public_rtmp_url }}/{{ $ms_config->rtmp_prefix }}">
                        <label for="streamkey">Stream Key</label>
                        <input class="form-control" id="streamKeyInput" data-stream-key="{{ $stream->uuid }}"
                               value="●●●●●●●●●●●●●●●●●●●●●●●●●●●●●●">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@section('scripts.footer')
    @parent
@endsection