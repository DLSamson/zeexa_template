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