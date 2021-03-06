<?php

namespace App\Http\Controllers;

class ArtistsController extends Controller
{
    public function view(string $artist)
    {
        /* @var \App\Services\Spotify $spotify */
        $spotify = resolve('App\Services\Spotify');
        $res = $spotify->getArtist($artist);
        return view('artist', [
            'artist' => $res
        ]);
    }
}
