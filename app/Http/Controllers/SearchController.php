<?php

namespace App\Http\Controllers;

use App\Services\Spotify;
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
        if (empty($query)) {
            abort(500, "search keyword can't be empty");
        }
        /* @var Spotify $spotify */
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
