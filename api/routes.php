<?php

use App\Controllers\PingController;
use App\Middlewares\JsonMiddleware;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
	$app->group('/api', function (RouteCollectorProxy $group) {
		$group->get('/ping', PingController::class);

		$group->get('/brands', [\App\Controllers\BrandController::class, 'brands']);
		$group->get('/brands/popular', [\App\Controllers\BrandController::class, 'popular']);

		$group->get('/models', [\App\Controllers\ModelController::class, 'models']);
		$group->get('/serials', [\App\Controllers\SerialController::class, 'serials']);
		$group->get('/offices', [\App\Controllers\OfficeController::class, 'offices']);

		$group->post('/auth/send-code', [\App\Controllers\AuthController::class, 'sendCode']);
		$group->post('/auth/token', [\App\Controllers\AuthController::class, 'getToken']);
	})
		->add(JsonMiddleware::class);
};