<div class="row">
    <div class="col-md-12">
        <h2>Game Library</h2>
        <div class="pull-right">
            <button>Go Live</button>
        </div>
        <div class="form-group">
            <label>Game search</label>
            <input data-role="game-query" class="form-control" type="text" name="query"/>
        </div>
    </div>
    <div class="col-sm-12" style="max-height:500px; overflow: auto" data-role="game-results"></div>
</div>

@section('sidebars.content')
    <div style="max-height:500px;overflow:auto" data-role="game-list">
        <table class="table table-condensed">
            <tr>
                <th>Game</th>
                <th>Platform</th>
                <th>Status</th>
            </tr>
            @foreach($game_collection as $item)
                <tr data-game-id="{{ $item->id }}">
                    <td>{{ $item->name }}</td>
                    <td>{{ \Jiko\Gaming\Models\Platform::find($item->pivot->platform_id)->name }}</td>
                    <td>[{{ $item->pivot->status }}]</td>
                    <td>
                        <button class="btn btn-danger">X</button>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    @parent
@stop