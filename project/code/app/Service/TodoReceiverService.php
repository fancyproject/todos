<?php

namespace App\Service;

use App\Service\ClientInterface;
use Illuminate\Http\Response;

class TodoReceiverService
{
    /** @var ClientInterface */
    private $clientInterface;

    /**
     * TodoReceiverService constructor.
     * @param \App\Service\ClientInterface $clientInterface
     */
    public function __construct(ClientInterface $clientInterface)
    {
        $this->clientInterface = $clientInterface;
    }

    /**
     * @return mixed|null
     */
    public function getItems()
    {
        $response = $this->clientInterface->get($this->getUrl());
        if ($response->getStatusCode() == Response::HTTP_OK) {
            return json_decode($response->getBody()->getContents());
        }
        return null;
    }

    /**
     * @return string
     */
    private function getUrl()
    {
        return $url = config('services.todos.domain') . '/' . config('services.todos.endpoint');
    }
}