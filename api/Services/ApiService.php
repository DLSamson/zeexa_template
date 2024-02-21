<?php

namespace App\Services;

use Curl\Curl;
use Bitrix\Main\Data\Cache;
use Carbon\Carbon;
use Propaganistas\LaravelPhone\PhoneNumber;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

class ApiService
{
	protected static $user = null;
	protected Curl $curl;
	protected Cache $cache;
	public const BASE_URL = 'http://45.132.50.122:8081';

	public const TOKEN_NAME = 'auth_token';


	public const NOT_VALID = 'NOT_VALID';
	public const CANCELLED = 'CANCELLED';
	public const VALID = 'VALID';
	public const UNDER_MAINTANCE = 'UNDER_MAINTANCE';
	public const FINISHED = 'FINISHED';

	public function __construct(Curl $curl, Cache $cache)
	{
		$this->curl = $curl;
		$this->cache = $cache;
	}

	protected function setCache(string $name, int $timeToLive = 3600, ?array $data = [])
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

		$response = $this->curl->get(static::BASE_URL . '/brands')->response;

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
				"phoneNumber" => substr((new PhoneNumber($phone))->formatE164(), 1),
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
				"phoneNumber" => substr((new PhoneNumber($phone))->formatE164(), 1),
				"otp" => $code
			])
		)->response;

		// dd($response);

		return json_decode($response);
	}

	public function isAuthenticated(): bool {
		return !!$this->getUser();
	}

	public function getUser() {
		if (static::$user)
			return static::$user;

		$this->curl->setHeader('Content-Type', 'application/json');
		$this->curl->setHeader('Authorization', 'Bearer ' . $this->getAuthToken());

		$response = $this->curl->get(static::BASE_URL . '/users/my');
		if ($response->http_status_code == 200) {
			static::$user = json_decode($response->response);
			return static::$user;
		}

		return false;
	}

	public function getAuthToken() {
		return $_COOKIE[static::TOKEN_NAME] ?? false;
	}

	public function getPrices() {
		$response = $this->curl->get(static::BASE_URL . '/prices');
		return $response->http_status_code == 200 ? json_decode($response->response)->content : false;
	}

	public function getPricesByCategories() {
		$prices = $this->getPrices();
		$categories = [];
		foreach($prices as $price) {
			if (!$price->category)
				continue;

			$categories[$price->category][] = $price;
		}
		return $categories;
	}


	public function updateUser(array $data) {
		$data['id'] = static::$user->id;
		
		$this->curl->setHeader('Content-Type', 'application/json');
		$this->curl->setHeader('Authorization', 'Bearer ' . $this->getAuthToken());
		$response = $this->curl->post(static::BASE_URL . '/users/my', json_encode($data));
		return $response->http_status_code == 200 ? json_decode($response->response) : false;
	}

	public function getUserCars(){

		$this->curl->setHeader('Content-Type', 'application/json');
		$this->curl->setHeader('Authorization', 'Bearer ' . $this->getAuthToken());
		$response = $this->curl->get(static::BASE_URL . '/cars/my');
		return $response->http_status_code == 200 ? json_decode($response->response) : false;
	}

	public function getUserMaintances()
	{
		$this->curl->setHeader('Content-Type', 'application/json');
		$this->curl->setHeader('Authorization', 'Bearer ' . $this->getAuthToken());
		$response = $this->curl->get(static::BASE_URL . '/service/my');

		$result = $response->http_status_code == 200 ? json_decode($response->response) : false;
		if($result === false) {
			return false;
		}

		$prices = collect($this->getPrices());

		$result = collect($result)
			->map(function($maintance) use ($prices) {
				$maintance->services = $prices
					->filter(fn($price) => in_array($price->id, $maintance->services))
					->values()
					->toArray();

				return $maintance;
			})
			->toArray();

		return $result;
	}

	public function addCar($serial, $govNumber) {
		$this->curl->setHeader('Content-Type', 'application/json');
		$this->curl->setHeader('Authorization', 'Bearer ' . $this->getAuthToken());

		$response = $this->curl->post(static::BASE_URL . '/cars/my', [
			'carSerial' => $serial,
			'govNumber' => $govNumber,
			'user' => static::getUser(),
		], true);

		print_r($response->response);

		return json_decode($response->response);
	}

	public function addMaintance(int $carId, int $officeId, string $date, string $time, array $services, string $comment) {
		$this->curl->setHeader('Content-Type', 'application/json');
		$this->curl->setHeader('Authorization', 'Bearer ' . $this->getAuthToken());

		$car = collect($this->getUserCars())->filter(fn($car) => $carId == $car->id)->first();
		$office = collect($this->getOffices())->filter(fn($office) => $officeId == $office->id)->first();
		$user = $this->getUser();
		// $services = collect($this->getPrices())
		// 	->filter(fn($service) => in_array(
		// 		$service->id, 
		// 		collect($services)->map(fn($service) => (int) $service)->toArray()
		// 	))
		// 	->values()
		// 	->toArray();

		$data = [
			'car' => $car,
			'office' => $office,
			// 'user' => $user,
			'userDescription' => $comment,
			'appointmentTime' => substr(Carbon::parse("{$date}")
				->startOfDay()
				->addHours(Carbon::parse($time)->format('H'))
				->setTimezone('UTC')
				->format(\DateTime::ISO8601), 0, -5),
			'services' => $services
		];

		// dd(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));

		$response = json_decode(
			$this->curl->post(static::BASE_URL . '/service/my', $data, true)->response);

		return $response;
	}
	
	public function cancelMaintance(int $id) {
		$this->curl->setHeader('Content-Type', 'application/json');
		$this->curl->setHeader('Authorization', 'Bearer ' . $this->getAuthToken());


	}
}
