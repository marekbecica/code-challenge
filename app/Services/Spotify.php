<?php


namespace App\Services;
use Exception;
use GuzzleHttp\Client;

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

    /**
     * Get Spotify access token
     * @param string $id
     * @param string $secret
     * @return string
     */
    private function getToken(string $id, string $secret) : string {
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
            $body = json_decode((string) $res->getBody(),true);
            $token = $body['access_token'];
            return $token;
        } catch (Exception $e){
            report($e);
            abort(500, 'Failed to get Spotify access token. Try again later.');
        }
        return false;
    }

    /**
     * Search for given type by query
     * @param string $type
     * @param string $query
     * @return array
     */
    public function search(string $type, string $query) : array {
        $url = self::SPOTIFY_API . 'search';
        $query = [
            'q' => $query,
            'type' => $type
        ];
        return $this->getRequest($url, $query);
    }

    /**
     * Search artist by query
     * @param string $query
     * @return array
     */
    public function searchArtists(string $query) : array {
        return $this->search(self::ARTIST, $query);
    }

    /**
     * Search track by query
     * @param string $query
     * @return array
     */
    public function searchTracks(string $query) : array {
        return $this->search(self::TRACK, $query);
    }

    /**
     * search album by query
     * @param string $query
     * @return array
     */
    public function searchAlbums(string $query) : array {
        return $this->search(self::ALBUM, $query);
    }

    /**
     * Search withing albums, tracks and artists by given query
     * @param string $query
     * @return array
     */
    public function searchAll(string $query) : array {
        return $this->search(
            implode(",", [
                    self::ALBUM,
                    self::TRACK,
                    self::ARTIST]),
            $query);
    }

    /**
     * Get album by id
     * @param string $id
     * @return array
     */
    public function getAlbum(string $id) : array {
        $url = self::SPOTIFY_API . 'albums/' . $id;
        return $this->getRequest($url);
    }

    /**
     * Get artist by id
     * @param string $id
     * @return array
     */
    public function getArtist(string $id) : array {
        $url = self::SPOTIFY_API . 'artists/' . $id;
        return $this->getRequest($url);
    }

    /**
     * Get track by id
     * @param string $id
     * @return array
     */
    public function getTrack(string $id) : array {
        $url = self::SPOTIFY_API . 'tracks/' . $id;
        return $this->getRequest($url);
    }

    /**
     * Send get request with authorization by access token
     * @param string $url
     * @param array $params
     * @return array
     */
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
        } catch (Exception $e){
            report($e);
            return [];
        }
    }

}