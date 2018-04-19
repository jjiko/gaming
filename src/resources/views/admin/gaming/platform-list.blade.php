<div class="row">
    <div class="col-xs-12">
        <h2>Platforms</h2>
    </div>
</div>
@foreach($collection as $platform)
    <div class="row">
        <div class="col-xs-12">
            @if($platform->logo)
                <img src="{{ $platform->logo }}">
                <hr>
            @endif
            <button class="btn btn-default">Edit</button> &nbsp; {{ $platform->name }} ({{ $platform->abbreviation }})
            <form action="/admin/gaming/platform/{{ $platform->id }}" method="post">
                <input type="hidden" name="_method" value="PUT">
                <div class="input-group">
                    <input class="form-control" type="text" name="logo_url" value="{{ $platform->logo }}">
                    <div class="input-group-btn">
                        <button class="btn btn-default">Set logo (URL)</button>
                    </div>
                </div>
            </form>
            <hr>
        </div>
    </div>
@endforeach