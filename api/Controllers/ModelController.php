<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ModelController extends HttpController
{
	public function models(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
	{
		$params = $request->getQueryParams();
		$data = $this->apiService->getModels($params['brand'], $params['page'], $params['size']);
		$response->getBody()->write(json_encode($data));
		return $response->withStatus(200);
	}
}