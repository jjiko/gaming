<?php if (!isset($platforms)) {
  $platforms = Jiko\Gaming\Models\Platform::all();
  if ($live = $user->games()->live()->first()) {
    $live_value = sprintf("%s (%s)", $live->name, $platforms->where('id', $live->pivot->platform_id)->pluck('abbreviation')->first());
  } else {
    $live_value = "";
  }
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label>Name/Platform Filter</label>
                    <input data-role="game filter" data-filter='["game-name","platform-name"]' class="form-control"
                           type="text"
                           name="query"/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status" data-role="game status filter"
                            data-selected="">
                        @foreach(['','Playing', 'Wishlist', 'Pre-ordered', 'Completed', 'Backlog', 'Dropped'] as $status)
                            <option>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-condensed" id="table-game-list">
            <tr>
                <th>Game</th>
                <th>Platform</th>
                <th>Status</th>
            </tr>
            @if(isset($game_collection) && count($game_collection))
                @foreach($game_collection as $item)
                    <tr data-role="game filter row" data-game-id="{{ $item->id }}"
                        data-platform-id="{{ $item->pivot->platform_id }}">
                        <td class="game-name">{{ $item->name }}</td>
                        <td class="platform-name">{{ $platforms->where('id', $item->pivot->platform_id)->pluck('abbreviation')->first() }}</td>
                        <td class="game-status">
                            <select class="form-control select-game-status" name="status" data-role="update game status"
                                    data-selected="{{ $item->pivot->status }}">
                                @foreach(['Playing', 'Wishlist', 'Pre-ordered', 'Completed', 'Backlog', 'Dropped'] as $status)
                                    @if($status == $item->pivot->status)
                                        <option selected>{{ $status }}</option>
                                    @else
                                        <option>{{ $status }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <button data-role="delete game from list" class="btn btn-danger">X</button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td>No games</td>
                </tr>
            @endif
        </table>
    </div>
</div>