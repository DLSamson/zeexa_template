<?php

namespace App\Controllers;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;

class PingController
{
	public function __invoke(ResponseInterface $response): ResponseInterface
	{
		$response->getBody()->write('"pong"');
		return $response->withStatus(200);
	}
}