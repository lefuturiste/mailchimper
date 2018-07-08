<?php

namespace App;

use Httper\Client;
use Httper\Request;
use Httper\Response;
use Httper\Uri;
use Psr\Http\Message\ResponseInterface;

class MailChimp
{
    private $apiKey;
    private $zone;
    /**
     * @var Client
     */
    private $client;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->zone = substr($apiKey, -4);
        $this->endpoint = "https://{$this->zone}.api.mailchimp.com/3.0";
        $this->client = new Client();
    }

    public function addSubscriber($listId, $email): Response
    {
        $response = $this->client->request(
            (new Request())
                ->withUri(new Uri($this->endpoint . "/lists/{$listId}/members"))
                ->withMethod('POST')
                ->withBasicAuth('u', $this->apiKey)
                ->withHeader('Content-Type', 'application/json')
                ->withJson(['email_address' => $email, 'status' => 'subscribed'])
        );
        return $response;
    }
}