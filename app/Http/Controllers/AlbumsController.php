<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlbumsController extends Controller
{
    public function view(string $album)
    {
        /* @var \App\Services\Spotify $spotify */
        $spotify = resolve('App\Services\Spotify');
        $res = $spotify->getAlbum($album);
        return view('album', [
            'album' => $res
        ]);
    }
}
