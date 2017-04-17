<h1>Platforms</h1>
<div class="row">
    @foreach($platforms as $platform)
        <div class="col-md-4">
            <a class="btn" href="{{ route('gaming_platform', [$platform->abbreviation]) }}">{{ $platform->name }} ({{ $platform->game->count() }})</a>
        </div>
    @endforeach
</div>