<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\Validator\Constraints as Assert;

class AuthController extends HttpController
{
    public function sendCode(ServerRequestInterface $request, ResponseInterface $response)
    {
        $data = $request->getParsedBody();
        $errors = $this->validate($data, new Assert\Collection([
            'phone' => [new Assert\Required(), new Assert\NotBlank(), new Assert\NotNull()]
        ]));

        if ($errors->count() > 0) {
            $response->getBody()->write(json_encode($errors));
            return $response->withStatus(400);
        }

        $data = $this->apiService->sendCode($data['phone']);
        $response->getBody()->write(json_encode($data));
        return $response->withStatus(
            $data->success ? 200 : 500
        );
    }

    public function getToken(ServerRequestInterface $request, ResponseInterface $response)
    {
        $data = $request->getParsedBody();
        $errors = $this->validate($data, new Assert\Collection([
            'phone' => [new Assert\NotBlank(), new Assert\NotNull()],
            'code' => [new Assert\NotBlank(), new Assert\NotNull()],
        ]));

        if ($errors->count() > 0) {
            $response->getBody()->write(json_encode($errors));
            return $response->withStatus(400);
        }

        $data = $this->apiService->getToken($data['phone'], $data['code']);
        $response->getBody()->write(json_encode($data));
        return $response->withStatus(
            $data->success ? 200 : 400
        );
    }
}