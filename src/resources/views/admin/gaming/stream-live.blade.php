<h1>1. Set game</h1>
<div class="form-group">
    <label>Select platform</label>
    @foreach($user->platforms()->distinct()->orderBy('name')->get() as $platform)
        <img src="{{ $platform->image->get('thumb_url') }}" alt="{{$platform->name}}">
    @endforeach
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