<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$artist['name']}}</title>
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
    @if(isset($artist['images'][1]))
        <img src ="{{$artist['images'][1]['url']}}" width="200" height="200"><br>
    @endif
    <h2>{{$artist['name']}}</h2>
        <table>
            <tr>
                <th>Genres</th>
                <td>
                    @foreach($artist['genres'] as $genre)
                        {{$genre}}<br>
                    @endforeach
                </td>
            </tr>
            <tr>
                <th>Popularity</th>
                <td>
                    {{$artist['popularity']}}
                </td>
            </tr>

        </table>
</div>
</body>
</html>
