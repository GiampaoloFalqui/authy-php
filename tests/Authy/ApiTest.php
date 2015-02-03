<?php

class AuthyTest extends \PHPUnit_Framework_TestCase
{
    protected $api;

    public function setUp()
    {
        $this->api = new Authy\Api("f45ec9af9dcb7419dc52b05889c858e9", "sandbox");
    }

    public function testCreateUserWithValidDataJsonType()
    {
        $response = $this->api->client("json")->user()->register('user@example.com', '305-456-2345', 1);
        $this->assertRegExp("/User created successfully./", $response->body()->message);
    }

    public function testCreateUserWithValidDataXmlType()
    {
        $response = $this->api->client("xml")->user()->register('user@example.com', '305-456-2345', 1);
        $this->assertRegExp("/User created successfully./", $response->body()->message);
    }

}
