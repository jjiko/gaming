<table class="table table-condensed" id="table-game-list">
    <tr>
        <th>Game</th>
        <th>Platform</th>
        <th>Status</th>
    </tr>
    @if(isset($game_collection) && count($game_collection))
        @foreach($game_collection as $item)
            <tr data-game-id="{{ $item->id }}" data-platform-id="{{ $item->pivot->platform_id }}">
                <td>{{ $item->name }}</td>
                <td>{{ $platforms->where('id', $live->pivot->platform_id)->pluck('abbreviation')->first() }}</td>
                <td>
                    <select class="form-control" name="status" data-role="update game status">
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