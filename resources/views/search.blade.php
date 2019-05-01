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
        {{$album['id']}}<br>
        {{$album['name']}}<br>
        @if(isset($album['images'][0]))
        {{$album['images'][0]['url']}}<br>
        @endif
    @endforeach
    <h2>Artists</h2>
    @foreach($artists['items'] as $artist)
        {{$artist['id']}}<br>
        {{$artist['name']}}<br>
        @if(isset($artist['images'][0]))
            {{$artist['images'][0]['url']}}<br>
        @endif
    @endforeach
    <h2>Tracks</h2>
    @foreach($tracks['items'] as $track)
        {{$track['id']}}<br>
        {{$track['name']}}<br>
        @if(isset($track['images'][0]))
            {{$track['images'][0]['url']}}<br>
        @endif
    @endforeach
</div>
</body>
</html>
