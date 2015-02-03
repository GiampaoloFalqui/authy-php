<?php namespace Authy;

use GuzzleHttp\Message\Response as ClientResponse;

class Response {

    protected $response;

    protected $body;

    public function __construct(ClientResponse $response)
    {
        $this->response = $response;
        $this->body = $this->parse();
    }

    public function body()
    {
        return $this->body;
    }

    public function ok()
    {
        return $this->response->getStatusCode() === 200;
    }

    protected function parse()
    {
        if ($this->isJson()) {
            return $this->response->json(['object' => true]);
        }

        if ($this->isXml()) {
            return json_decode(json_encode($this->response->xml()));
        }
    }

    protected function isJson()
    {
        return ($this->response->getHeader('Content-Type') === 'application/json');
    }

    protected function isXml()
    {
        return ($this->response->getHeader('Content-Type') === 'application/xml;charset=utf-8');
    }

}