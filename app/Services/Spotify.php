<?php


namespace App\Services;
use GuzzleHttp\Client;
use Illuminate\Contracts\Session\Session;

class Spotify
{
    protected $secret;
    protected $id;
    protected $token;

    const SPOTIFY_API = "https://api.spotify.com/v1/";
    const ALBUM = "album";
    const TRACK = "track";
    const ARTIST = "artist";


    /**
     * Spotify constructor.
     * @param string $key
     */
    public function __construct(string $id, string $secret)
    {
        $this->secret = $secret;
        $this->id = $id;
        $this->token = $this->getToken($id, $secret);

    }
    private function getToken(string $id, string $secret) {
        /*$token = \session('token');
        $tokenExpires = \session('token_expires');


        if (!empty($token) && !empty($tokenExpires) &&
        */
        $client = new Client();
        try {
            $res = $client->post('https://accounts.spotify.com/api/token',
                [
                    'headers' => [
                        'Authorization' => 'Basic ' . base64_encode($id . ":" . $secret),
                        'Content-Type' => 'application/x-www-form-urlencoded'
                    ],
                    'form_params' => [
                        'grant_type' => 'client_credentials'
                    ]
                ]);
        } catch (\Exception $e){
            var_dump($e->getMessage());
        }
        $body = json_decode((string) $res->getBody(),true);
        $token = $body['access_token'];
        /*$date = new \DateTime();
        $date->add('PT'.$body['expires_in'].'S');
        $tokenExpires = $date->getTimestamp();
        \session(['token' => $body['access_token'], 'token_expires' => $tokenExpires]);
        
        var_dump($body);*/
        return $token;
    }

    public function search(string $type, string $query) {
        $client = new Client();
        try {
            $res = $client->get(self::SPOTIFY_API . 'search',
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->token,
                        'Content-Type' => 'application/x-www-form-urlencoded'
                    ],
                    'query' => [
                        'q' => $query,
                        'type' => $type
                    ]
                ]);
        } catch (\Exception $e){
            var_dump($e->getMessage());
        }
        $body = json_decode((string) $res->getBody(),true);
        return $body;
    }

    public function searchArtists(string $query) {
        return $this->search(self::ARTIST, $query);
    }

    public function searchTracks(string $query) {
        return $this->search(self::TRACK, $query);
    }

    public function searchAlbums(string $query) {
        return $this->search(self::ALBUM, $query);
    }

    public function searchAll(string $query) {
        return $this->search(
            implode(",", [
                    self::ALBUM,
                    self::TRACK,
                    self::ARTIST]),
            $query);
    }
}