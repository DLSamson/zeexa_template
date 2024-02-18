<?php

namespace App\Controllers;

use App\Controllers\HttpController;
use Carbon\Carbon;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CarController extends HttpController
{
    public function addCar(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface {
        $data = $request->getParsedBody();

        $errors = $this->validate($data, new Assert\Collection([
            'govNumber' => [new Assert\NotBlank(), new Assert\NotNull()],
            'serial' => [new Assert\NotBlank(), new Assert\NotNull(), new Assert\Type('array')],
        ]));

        if ($errors->count() > 0) {
            $response->getBody()->write($errors->toJson());
            return $response->withStatus(400);
        }

        $this->apiService
            ->addCar($data['serial'], $data['govNumber']);

        return $response->withStatus(200);
    }
}