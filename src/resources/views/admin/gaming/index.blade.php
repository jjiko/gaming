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
    <div data-role="game-list">
        @include('admin::gaming.game-list')
        <a class="btn btn-warning" href="{{ route('admin_game_list') }}">View full list</a>
    </div>
    @parent
@stop