<?php namespace Authy;

use GuzzleHttp\Message\Response as ClientResponse;

abstract class Entity
{
    protected function response(ClientResponse $response)
    {
        return new Response($response);
    }
}