<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$track['name']}}</title>
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

    </style>
</head>
<body>
<div class="full-height">
    @if(isset($track['album']['images'][1]))
        <img src ="{{$track['album']['images'][1]['url']}}" width="300" height="300"><br>
    @endif
    <h2>{{$track['name']}}</h2>
    <table>
        <tr>
            <th>Artist</th>
            <td>
                @foreach($track['artists'] as $artist)
                    {{$artist['name']}}<br>
                @endforeach
            </td>
        </tr>
        <tr>
            <th>Album</th>
            <td>
                {{$track['album']['name']}}
            </td>
        </tr>
        <tr>
            <th>Duration</th>
            <td>
                {{round($track['duration_ms']/(1000*60))}} min
            </td>
        </tr>
    </table>
</div>
</body>
</html>
