<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TracksController extends Controller
{
    public function view(string $track)
    {
        /* @var \App\Services\Spotify $spotify */
        $spotify = resolve('App\Services\Spotify');
        $res = $spotify->searchAll($track);
        return view('album', [
        ]);
    }
}
