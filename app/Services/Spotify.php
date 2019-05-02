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
     * @param string $id
     * @param string $secret
     */
    public function __construct(string $id, string $secret)
    {
        $this->secret = $secret;
        $this->id = $id;
        $this->token = $this->getToken($id, $secret);

    }

    private function getToken(string $id, string $secret) : string {
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

    public function search(string $type, string $query) : array {
        $url = self::SPOTIFY_API . 'search';
        $query = [
            'q' => $query,
            'type' => $type
        ];
        return $this->getRequest($url, $query);
    }

    public function searchArtists(string $query) : array {
        return $this->search(self::ARTIST, $query);
    }

    public function searchTracks(string $query) : array {
        return $this->search(self::TRACK, $query);
    }

    public function searchAlbums(string $query) : array {
        return $this->search(self::ALBUM, $query);
    }

    public function searchAll(string $query) : array {
        return $this->search(
            implode(",", [
                    self::ALBUM,
                    self::TRACK,
                    self::ARTIST]),
            $query);
    }

    public function getAlbum(string $id) : array {
        $url = self::SPOTIFY_API . 'albums/' . $id;
        return $this->getRequest($url);
    }

    public function getArtist(string $id) : array {
        $url = self::SPOTIFY_API . 'artists/' . $id;
        return $this->getRequest($url);
    }

    public function getTrack(string $id) : array {
        $url = self::SPOTIFY_API . 'tracks/' . $id;
        return $this->getRequest($url);
    }


    private function getRequest(string $url, array $params = []) : array {
        $client = new Client();
        try {
            $res = $client->get($url,
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->token,
                        'Content-Type' => 'application/x-www-form-urlencoded'
                    ],
                    'query' => $params
                ]);
            $body = json_decode((string) $res->getBody(),true);
            return $body;
        } catch (\Exception $e){
            var_dump($e->getMessage());
            return [];
        }
    }

}