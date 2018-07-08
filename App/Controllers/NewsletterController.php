<?php

namespace App\Controllers;

use App\MailChimp;
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
            ])->withStatus(400);
        }
    }

    public function getEventSubscribe(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $response->withJson(true)->withStatus(200);
    }

    public function postEventSubscribe(ServerRequestInterface $request, ResponseInterface $response, Logger $logger)
    {
        $logger->info("new request body : " . json_encode($request->getParsedBody()));
        return $response->withJson([
            'success' => true
        ]);
    }
}
