<?php
$user = request()->user();
$games = $user->games;
$platforms = Jiko\Gaming\Models\Platform::all();
if ($live = $user->games()->live()->first()) {
  $live_value = sprintf("%s (%s)", $live->name, $platforms->where('id', $live->pivot->platform_id)->pluck('abbreviation')->first());
} else {
  $live_value = "";
}
?>
<div class="row">
    <div class="col-md-8">
        <h2>Set live game</h2>
        <form id="frm-update-live-game" method="post" action="/admin/gaming/game/live">
            <div class="input-group">
                <input class="form-control" list="games-list" type="text" id="live-selection"
                       data-live="{{ $live_value }}">
                <datalist id="games-list">
                    @foreach($games as $game)
                    <?php
                    $optvalue = sprintf("%s (%s)", $game->name, $platforms->where('id', $game->pivot->platform_id)->pluck('abbreviation')->first());
                    ?>
                        <option data-game-id="{{ $game->id }}"
                                data-platform-id="{{ $game->pivot->platform_id }}">{{ $optvalue }}</option>
                    @endforeach
                </datalist>
                <div class="input-group-btn">
                    <button class="btn btn-warning" id="btn-update-live-game">Update</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-4">
        <iframe style="width:240px;height:500px;border:none;" src="/api/g/stream/template?uid=2&name=cover"></iframe>
    </div>
</div>
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

@push('sidebars.content')
    <div data-role="game-list">
        @include('admin::gaming.game-list')
        <a class="btn btn-warning" href="{{ route('admin_game_list') }}">View full list</a>
    </div>
@endpush