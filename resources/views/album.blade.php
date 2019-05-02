<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$album['name']}}</title>
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
    @if(isset($album['images'][1]))
        <img src ="{{$album['images'][1]['url']}}" width="300" height="300"><br>
    @endif
    <h2>{{$album['name']}}</h2>
    <table>
        <tr>
            <th>Artist</th>
            <td>
                @foreach($album['artists'] as $artist)
                    {{$artist['name']}}<br>
                @endforeach
            </td>
        </tr>
        <tr>
            <th>Release Date</th>
            <td>
                {{$album['release_date']}}
            </td>
        </tr>
        <tr>
            <th>Tracks</th>
            <td>
                @foreach($album['tracks']['items'] as $track)
                    {{$track['name']}}<br>
                @endforeach
            </td>
        </tr>

    </table>
</div>
</body>
</html>
