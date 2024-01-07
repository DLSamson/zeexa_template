<?php

namespace App\Controllers;

use App\Services\ApiService;

class HttpController
{
	protected ApiService $apiService;

	public function __construct(ApiService $apiService) {
		$this->apiService = $apiService;
	}


}