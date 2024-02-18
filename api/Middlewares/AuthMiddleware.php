<?php

namespace App\Middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use HttpSoft\Message\Response;

class AuthMiddleware implements MiddlewareInterface
{
	/**
	 * @inheritDoc
	 */
	public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
	{
        if(!getApi()->isAuthenticated()) {
            return (new Response())->withStatus(401);
        }

        return $handler->handle($request);
	}
}