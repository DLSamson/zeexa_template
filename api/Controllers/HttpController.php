<?php

namespace App\Controllers;

use App\Services\ApiService;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\ConstraintViolation;

class HttpController
{
	protected ApiService $apiService;
	protected ValidatorInterface $validator;

	public function __construct(ApiService $apiService, ValidatorInterface $validator)
	{
		$this->apiService = $apiService;
		$this->validator = $validator;
	}

	protected function validate($data, $constraints)
	{
		return collect($this->validator->validate($data, $constraints))
			->map(function (ConstraintViolation $error) {
				return [
					'field' => substr($error->getPropertyPath(), 1, -1),
					'message' => $error->getMessage(),
				];
			});
	}


}