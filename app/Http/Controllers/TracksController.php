<?php

namespace App\Http\Controllers;

class TracksController extends Controller
{
    public function view(string $track)
    {
        /* @var \App\Services\Spotify $spotify */
        $spotify = resolve('App\Services\Spotify');
        $res = $spotify->getTrack($track);
        return view('track', [
            'track' => $res
        ]);
    }
}
