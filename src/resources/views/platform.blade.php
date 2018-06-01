@foreach($platforms as $platform)
    <h2>{{ $platform->name }}</h2>
    <div class="game-row">
        @foreach($platform->game as $game)
            <div class="game-col">
                <img class="game-cover img-responsive img-fade-in" src="{{ $game->image->get('thumb_url') }}" alt="{{ $game->name }}">
            </div>
        @endforeach
    </div>
@endforeach

@push('styles')
    <style>
        .game-row {
            display: flex;
            flex-wrap: wrap;
            padding: 0 4px;
        }

        /* Create four equal columns that sits next to each other */
        .game-col {
            flex: 15%;
            max-width: 15%;
            padding: 0 4px;
        }

        .game-col .game-cover {
            margin-top: 8px;
            vertical-align: middle;
        }

        /* Responsive layout - makes a two column-layout instead of four columns */
        @media screen and (max-width: 800px) {
            .game-col {
                flex: 50%;
                max-width: 50%;
            }
        }

        /* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {
            .game-col {
                flex: 100%;
                max-width: 100%;
            }
        }
    </style>
@endpush