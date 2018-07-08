<?php

namespace App\Middlewares;

use DI\Container;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CORSMiddleware
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $next): ResponseInterface
    {
        $response = $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Methods	', 'POST, PUT, GET, OPTIONS')
            ->withHeader('Access-Control-Allow-Headers', 'Origin, Content-Type, Authorization');

        if ($request->getMethod() == "OPTIONS") {
            return $response->withJson(true);
        }
        return $next($request, $response);
    }
}