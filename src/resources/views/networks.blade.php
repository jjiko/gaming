<article class="row">
    <div class="col-md-12">
        <h2>Let's play!</h2>

        <p>Add me to your game networks</p>

        <div class="table-responsive">
            <table class="table table-condensed">
                <tr>
                    <th style="width:30%">Service</th>
                    <th>Username/Friend code</th>
                </tr>
                @foreach($networks as $network)
                    <tr>
                        <td>
                            @if(isset($network->img_background))
                                    <img class="img-responsive" alt="{{ $network->name }}"
                                         src="{{ cdn_img_path() . '/gaming/networks/logo-' .  str_replace('.', '', str_replace(' ', '', strtolower($network->name))) . '.' . (isset($network->img_type) ? $network->img_type : 'png') }}" style="background-color: {{ $network->img_background }}; padding: 5px">
                            @else
                                <img class="img-responsive" alt="{{ $network->name }}"
                                     src="{{ cdn_img_path() . '/gaming/networks/logo-' .  str_replace('.', '', str_replace(' ', '', strtolower($network->name))) . '.' . (isset($network->img_type) ? $network->img_type : 'png') }}">
                            @endif
                        </td>
                        <td>
                            {{ $network->id }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</article>