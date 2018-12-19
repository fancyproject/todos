<?php namespace App\Service;

use Psr\Http\Message\ResponseInterface;

interface ClientInterface
{
    public function get(string $url): ResponseInterface;
}