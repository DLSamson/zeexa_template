<?php

use Bitrix\Main\Data\Cache;
use Curl\Curl;


if(!function_exists('getApi'))
{
    function getApi()
    {
        return new \App\Services\ApiService(
            new Curl(),
            Cache::createInstance()
        );
    }
}

if(!function_exists('render')) {
    function render(string $path, $data = []) {
        (function ($path, $data)  {
            extract($data);
            require $_SERVER['DOCUMENT_ROOT'] . '/local/templates/zeexa/api/Templates/' . $path;
        })($path, $data);
    }
}