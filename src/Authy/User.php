<?php namespace Authy;

use GuzzleHttp\Client;

class User extends Entity {

    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function register($email, $cellphone, $countryCode)
    {
        $response = $this->client->post(
            'users/new',
            ['query' =>
                [
                    'user' => [
                        'email'        => $email,
                        'cellphone'    => $cellphone,
                        'country_code' => $countryCode
                    ]
                ]
            ]
        );

        return $this->response($response);
    }

}