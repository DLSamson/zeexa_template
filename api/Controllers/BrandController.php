<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class BrandController extends HttpController
{
	public function popular(ServerRequestInterface $request, ResponseInterface $response) {
		$data = $this->apiService->getPopularBrands();
		$response->getBody()->write(json_encode($data));
		return $response->withStatus(200);
	}

	public function brands(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
	{
		$params = $request->getQueryParams();
		$data = $this->apiService->getBrands($params['page'], $params['size']);
		$response->getBody()->write(json_encode($data));
		return $response->withStatus(200);
	}
}