<form action="/gaming/embed/widget" method="post">
    <div class="form-group">
        @foreach($games as $game)
            <div class="col-md-3">
                <label><input name="ids[]" type="checkbox" value="{{ $game->id }}"> {{ $game->name }}
                    ({{ \Jiko\Gaming\Models\Platform::find($game->pivot->platform_id)->abbreviation }})</label>
            </div>
        @endforeach
    </div>
    <div class="col-md-12">
        <div class="pull-right">
            <button class="btn btn-success">Create widget</button>
        </div>
    </div>
</form>