<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class OfficeController extends HttpController
{
    public function offices(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $data = $this->apiService->getOffices();
        $response->getBody()->write(json_encode($data));
        return $response->withStatus(200);
    }
}