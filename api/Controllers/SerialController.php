<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class SerialController extends HttpController
{
	public function serials(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
	{
		$params = $request->getQueryParams();
		$data = $this->apiService->getSerials($params['model']);
		$response->getBody()->write(json_encode($data));
		return $response->withStatus(200);
	}
}