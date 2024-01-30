<?php

namespace App\Services;

use Curl\Curl;
use Bitrix\Main\Data\Cache;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

class ApiService
{
	protected Curl $curl;
	protected Cache $cache;
	protected const BASE_URL = 'http://45.132.50.122:8081';

	protected const TOKEN_NAME = 'auth_token';

	public function __construct(Curl $curl, Cache $cache)
	{
		$this->curl = $curl;
		$this->cache = $cache;
	}

	protected function setCache(string $name, int $timeToLive, array $data)
	{
		$this->cache->initCache($timeToLive, $name, '/api/' . md5($name));
		$this->cache->startDataCache();
		$this->cache->endDataCache($data);
	}

	protected function getCache(string $name, int $timeToLive)
	{
		$this->cache->initCache($timeToLive, $name, '/api/' . md5($name));
		return $this->cache->getVars();
	}

	public function getBrand(int $id)
	{
		return $this->curl->get(static::BASE_URL . '/brands/$id');
	}

	public function getBrands(int $page = null, int $size = null): array
	{
		if ($response = $this->getCache("getBrands:$page,$size", 10800))
			return $response;

		$response = $this->curl->get(static::BASE_URL . '/brands/filter', collect([
			'page' => $page,
			'size' => $size
		])
			->filter(fn($el) => !is_null($el))
			->toArray())->response;

		$data = collect(json_decode($response)->content)
			->values()
			->toArray();

		$this->setCache("getBrands:$page,$size", 10800, $data);
		return $data;
	}

	public function getPopularBrands(): array
	{
		if ($response = $this->getCache('getPopularBrands', 10800))
			return $response;

		$response = $this->curl->get(static::BASE_URL . '/brands')->response;
		$data = collect(json_decode($response)->content)
			->filter(fn($el) => $el->popular > 0)
			->values()
			->toArray();

		$this->setCache('getPopularBrands', 10800, $data);
		return $data;
	}

	public function getModels(string $brand): array
	{
		if ($response = $this->getCache("getModels:$brand", 10800))
			//			dd($response);
			return $response;

		$response = $this->curl->get(static::BASE_URL . '/carModels')->response;
		$data = collect(json_decode($response)->content)
			->filter(fn($el) => $el->brand->id == $brand)
			->values()
			->toArray();

		$this->setCache("getModels:$brand", 10800, $data);
		return $data;
	}

	public function getSerials(string $model): array
	{
		if ($response = $this->getCache("getSerials:$model", 10800))
			return $response;

		$response = $this->curl->get(static::BASE_URL . '/carSerials')->response;
		$data = collect(json_decode($response)->content)
			->filter(fn($el) => $el->carModel->id == $model)
			->values()
			->toArray();

		$this->setCache("getSerials:$model", 10800, $data);
		return $data;
	}

	public function getOffices(): array
	{
		if ($response = $this->getCache("getOffices", 10800))
			return $response;

		$response = $this->curl->get(static::BASE_URL . '/offices')->response;
		$data = json_decode($response)->content;

		$this->setCache("getOffices", 10800, $data);
		return $data;
	}

	public function sendCode(string $phone): object
	{
		$this->curl->setHeader('Content-Type', 'application/json');
		$response = $this->curl->post(static::BASE_URL . '/auth/sms/request', 
			json_encode([
				"acceptedGDRP" => true,
				"phoneNumber" => $phone,
			])
		)->response;

		return json_decode($response);
	}

	public function getToken(string $phone, string $code): object
	{
		$this->curl->setHeader('Content-Type', 'application/json');
		$response = $this->curl->post(static::BASE_URL . '/auth/sms', 
			json_encode([
				"acceptedGDRP" => true,
				"phoneNumber" => $phone,
				"code" => $code
			])
		)->response;

		return json_decode($response);
	}

	public function isAuthenticated(): bool {
		return !!$this->getUser();
	}

	public function getUser() {
		$this->curl->setHeader('Content-Type', 'application/json');
		$this->curl->setHeader('Authorization', 'Bearer ' . $this->getAuthToken());
		$response = $this->curl->get(static::BASE_URL . '/users/my');
		return $response->http_status_code == 200 ? json_decode($response->response) : false;
	}

	public function getAuthToken() {
		return $_COOKIE[static::TOKEN_NAME] ?? false;
	}


}