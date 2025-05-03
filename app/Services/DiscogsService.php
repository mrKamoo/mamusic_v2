<?php
namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class DiscogsService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = config('services.discogs.api_key');
    }


    private function getFromDiscogs($endpoint, $params = [])
    {
        
            $params['key'] = $this->apiKey;
            $params['secret'] = config('services.discogs.api_secret');
            
            try {
            $response = $this->client->get("https://api.discogs.com/" . $endpoint, [
                'query' => $params,
            ]);
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }
    

    public function searchArtist($artistName)
    {
        return $this->getFromDiscogs('database/search', [
            'q' => $artistName,
            'type' => 'artist',
        ]);
    }
    public function searchAlbumByBarcode($barcode)
    {
        return $this->getFromDiscogs('database/search', [
            'q' => $barcode,
            'type' => 'release',
        ]);
    }
    public function searchAlbumById($id)
    {
        return $this->getFromDiscogs('releases/' . $id);
    }
}
