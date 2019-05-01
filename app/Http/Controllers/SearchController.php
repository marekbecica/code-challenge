<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        return view('index');
    }


    public function search(Request $request)
    {
        $query = $request->get('query');
        /* @var \App\Services\Spotify $spotify */
        $spotify = resolve('App\Services\Spotify');
        $res = $spotify->searchAll($query);
        $albums = $res['albums'];
        $tracks = $res['tracks'];
        $artists = $res['artists'];
        return view('search', [
            'searchTerm' => $query,
            'albums' => $albums,
            'tracks' => $tracks,
            'artists' => $artists
        ]);
    }
}
