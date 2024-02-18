<?php

namespace App\Controllers;

use App\Controllers\HttpController;
use Carbon\Carbon;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\Validator\Constraints as Assert;

class AuthController extends HttpController
{
    public function getUser(ServerRequestInterface $request, ResponseInterface $response) {
        if(!$user = $this->apiService->getUser()) {
            return $response->withStatus(401);
        }
        $response->getBody()->write(json_encode($user));
        return $response->withStatus(200);
    }

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

    public function updateUser(ServerRequestInterface $request, ResponseInterface $response) {
        $data = $request->getParsedBody();
        $data['birthdate'] = Carbon::parse($data['birthdate'])->format('Y-m-d');

        $errors = $this->validate($data, new Assert\Collection([
            'phone' => [new Assert\NotBlank(), new Assert\NotNull()],
            'name' => [new Assert\NotBlank(), new Assert\NotNull()],
            'surname' => [new Assert\NotBlank(), new Assert\NotNull()],
            'patronymic' => [new Assert\Optional(), new Assert\NotNull()],
            'nopatronymic' => [new Assert\Optional()],
            'birthdate' => [new Assert\NotBlank(), new Assert\NotNull(), new Assert\Date()],
            'gender' => [new Assert\NotBlank(), new Assert\NotNull(), new Assert\Choice(['M', 'F'])],
        ]));

        if($errors->count() > 0) {
            $response->getBody()->write(json_encode($errors));
            return $response->withStatus(400);
        }

        $data = $this->apiService->updateUser($data);
        $response->getBody()->write(json_encode($data));
        return $response->withStatus(200);
    }
}