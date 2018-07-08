<?php

namespace App\Controllers;

use App\MailChimp;
use DiscordWebhooks\Client;
use DiscordWebhooks\Embed;
use function DusanKasan\Knapsack\toArray;
use Monolog\Logger;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Validator\Validator;

class NewsletterController extends Controller
{
    public function postSubscribe(ServerRequestInterface $request, ResponseInterface $response, MailChimp $mailChimp)
    {
        $validator = new Validator($request->getParsedBody());
        $validator->required('email')
            ->email('email')
            ->notEmpty('email');

        if ($validator->isValid()) {
            $mailChimpResponse = $mailChimp->addSubscriber(
                $this->container->get('mailchimp')['list_id'],
                $validator->getValue('email')
            );

            if ($mailChimpResponse->getStatusCode() == 200) {
                return $response->withJson([
                    'success' => true
                ]);
            } else {
                return $response->withJson([
                    'success' => false,
                    'errors' => $mailChimpResponse->getParsedBody()
                ])->withStatus($mailChimpResponse->getStatusCode());
            }
        } else {
            return $response->withJson([
                'success' => false,
                'errors' => $validator->getErrors()
            ]);
        }
    }

    public function getEvent(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $response->withJson(true)->withStatus(200);
    }

    public function postEvent(ServerRequestInterface $request, ResponseInterface $response, Logger $logger)
    {
        $data = $request->getParsedBody();
//        $data = json_decode("{\"type\":\"subscribe\",\"fired_at\":\"2018-07-08 21:43:17\",\"data\":{\"id\":\"653cba3ea2\",\"email\":\"helle@deleteme.com\",\"email_type\":\"html\",\"ip_opt\":\"163.172.159.182\",\"web_id\":\"42193373\",\"merges\":{\"EMAIL\":\"helle@deleteme.com\",\"FNAME\":\"\",\"LNAME\":\"\",\"ADDRESS\":\"\",\"PHONE\":\"\"},\"list_id\":\"d9a684ec79\"}}");
        $data = json_decode(json_encode($data), true);
        $webhook = new Client($this->container->get('mailchimp')['discord_wh']);
        $embed = new Embed();
        switch ($data['type']) {
            case "subscribe":
                $embed->color("27ae60");
                $embed->title("New subscriber!");
                $embed->field("Email", $data['data']['email']);
                $embed->field("Ip", $data['data']['ip_opt']);
                $embed->field("At", $data['fired_at']);
                $embed->field("Id", $data['data']['id']);
                try {
                    $webhook->embed($embed)->send();
                } catch (\Exception $e) {
                    return $response->withJson([
                        'success' => false
                    ]);
                }
                break;
        }
        return $response->withJson([
            'success' => true
        ]);
    }
}
