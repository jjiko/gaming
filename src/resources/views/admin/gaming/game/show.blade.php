<style>
    .btn-file {
        position: relative;
        overflow: hidden;
    }

    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }
</style>

<h1 data-game-id="{{$game->id}}">{{ $game->name }}</h1>
@foreach($game->platforms as $platform)
    <h2 data-platform-id="{{ $platform->id }}">{{ $platform->name }}</h2>
@endforeach
Giantbomb: {{ $game->gbid }}<br>
<div style="width: auto; height:600px;overflow-y: hidden; overflow-x:auto; white-space:  nowrap;">
    @foreach($game->image as $i => $image)
        <img data-image-key="{{ $i }}" src="{{ $image }}" style="max-height: 600px; display: inline-block">
    @endforeach
</div>

<div class="row">
    <div class="col-sm-12">
        <form data-role="set game cover url" action="/admin/gaming/game/{{ $game->id }}">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="game-id" value="{{ $game->id }}">
            <input class="form-control" type="text" name="local_cover_url">
            <select class="form-control" name="platform-id">
                @foreach($game->platforms as $platform)
                    <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                @endforeach
            </select>
            <button class="btn btn-default">Set cover (URL)</button>
        </form>
    </div>
</div>
<button class="btn btn-default" disabled>Crop cover</button>
<form data-role="upload game cover" action="/admin/upload-async" enctype="multipart/form-data" method="POST">
    <div class="btn-group">
        <label class="btn btn-default btn-file">
            Browse &hellip; <input type="file" name="image" style="display: none">
        </label>
        <button type="submit" class="btn btn-success">Upload</button>
    </div>
</form>