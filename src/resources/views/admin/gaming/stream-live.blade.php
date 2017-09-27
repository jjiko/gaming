<?php
if (!isset($platforms)) {
  $platforms = Jiko\Gaming\Models\Platform::all();
}
?>
<h1>1. Set game</h1>

<div class="form-group">
    <label>Recently live</label>
  <?php $recent = $user->games()->whereNotNull('live_created_at')->limit(10)->get(); ?>
    <div class="row">
        @foreach($recent as $game)
            <div class="col-md-2" data-game-id="{{ $game->id }}" data-platform-id="{{ $game->pivot->platform_id }}">
                <label>
                    <input type="radio" name="game" value="{{ $game->id }}"
                           data-platform-id="{{ $game->pivot->platform_id }}">
                    <img src="{{ $game->image->get('thumb_url') }}" alt="{{ $game->name }}">
                </label>
            </div>
        @endforeach
    </div>
</div>
<div class="form-group">
    <label>Select platform</label>
    <div class="row">
        @foreach($platforms as $platform)
            <div class="select-platform col-md-2">
                <label>
                    <input name="platform" value="{{ $platform->id }}" type="radio">
                    <img width="64px" height="auto" src="{{ $platform->image->get('thumb_url') }}"
                         alt="{{$platform->abbreviation}}">
                </label>
            </div>
        @endforeach
    </div>
</div>

<div class="form-group">
    <label>Select game</label>
    <input list="games" name="game" type="text" class="form-control">
    <datalist id="games">
        @foreach($user->games as $game)
            <option>{{$game->name}}</option>
        @endforeach
    </datalist>
</div>

<h2>2. Configure OBS</h2>
<h2>3. Configure stream meta (title, description)</h2>
<h2>4. Go live</h2>