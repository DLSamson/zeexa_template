<?php

namespace App\Controllers;

use App\Controllers\HttpController;
use Carbon\Carbon;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\Validator\Constraints as Assert;

class MaintanceController extends HttpController
{
    public function addMaintance(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface {
        $data = $request->getParsedBody();
        $result = $this->apiService->addMaintance($data['carId'],$data['officeId'],$data['date'],$data['time'],$data['services'],$data['comment']);

        $response->getBody()->write(json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)); 
        return $response->withStatus(200);
    }

    public function cancelMaintance(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface {
        $data = $request->getParsedBody();
        $result = $this->apiService->cancelMaintance($data['id']);

        $response->getBody()->write(json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

        return $response->withStatus(200);
    }
}