<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Code Challenge</title>
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: sans-serif;
            height: 100vh;
            margin: 50px;
        }

        .full-height {
            height: 100vh;
        }

        .result {
        }
    </style>
</head>
<body>
<div class="full-height">
    <div class="result">
        Your Search Term Was: <b>{{$searchTerm}}</b>
    </div>
    <h2>Albums</h2>
    @foreach($albums['items'] as $album)
        <a href="{!! url('albums', [$album['id']]) !!}">{{$album['name']}}</a><br>
        @if(isset($album['images'][2]))
        <img src ="{{$album['images'][2]['url']}}" width="64" height="64" alt="{{$album['name']}}"><br>
        @endif
    @endforeach
    <h2>Artists</h2>
    @foreach($artists['items'] as $artist)
        <a href="{!! url('artists', [$artist['id']]) !!}">{{$artist['name']}}</a><br>
        @if(isset($artist['images'][2]))
            <img src ="{{$artist['images'][2]['url']}}" width="64" height="64"><br>
        @endif
    @endforeach
    <h2>Tracks</h2>
    @foreach($tracks['items'] as $track)
        <a href="{!! url('tracks', [$track['id']]) !!}">{{$track['name']}}</a><br>
        @if(isset($track['album']['images'][2]))
            <img src ="{{$track['album']['images'][2]['url']}}" width="64" height="64"><br>
        @endif
    @endforeach
</div>
</body>
</html>
