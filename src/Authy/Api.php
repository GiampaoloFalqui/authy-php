<?php namespace Authy;

require_once __DIR__ . '/../../bootstrap.php';

class Api {

    const VERSION        = "3.0.0";

    const URL_PRODUCTION = "https://api.authy.com";

    const URL_SANDBOX    = "http://sandbox-api.authy.com";

    protected $key;

    protected $mode;

    protected $client;

    public function __construct($key, $mode = "production")
    {
        $this->key = $key;
        $this->mode = $this->getModeUrl($mode);
    }

    public function client($format = "json")
    {
        if (! $this->isFormatValid($format))
        {
            throw new AuthyException("{$format} format is not accepted from Authy's API.");
        }

        $this->client = new \GuzzleHttp\Client([
            'base_url' => "{$this->mode}/protected/{$format}/",
            'defaults' => [
                'headers' => ['User-Agent' => 'authy-api v' . Api::VERSION],
                'query'   => ['api_key' => $this->key]
            ]
        ]);

        return $this;
    }

    public function user()
    {
        return new User($this->client);
    }

    protected function isFormatValid($format)
    {
        $formats = ["json", "xml"];
        return (in_array($format, $formats) === true) ? $format : FALSE;
    }

    protected function getModeUrl($mode)
    {
        $urls = ['production' => Api::URL_PRODUCTION, 'sandbox' => Api::URL_SANDBOX];
        return (isset($urls[$mode]) === true) ? $urls[$mode] : $mode;
    }

}