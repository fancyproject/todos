<?php namespace App\Service;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class HttpClient implements ClientInterface
{
    /** @var Client */
    private $client;

    /**
     * HttpClient constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function get(string $url): ResponseInterface
    {
        return $this->client->get($url);
    }
}