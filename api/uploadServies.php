<?php

if ($_GET['key'] !== 'qwrbqwfgiyqi')
    exit();


define("STATISTIC_SKIP_ACTIVITY_CHECK", "true");
define('STOP_STATISTICS', true);
define('PUBLIC_AJAX_MODE', true);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
require_once dirname(__FILE__, 2) . '/vendor/autoload.php';

$data = file_get_contents('./json/services.json');
$data = json_decode($data, true);

dump($data);
exit();

foreach ($data as $sectionName => $services) {
    $bs = new CIBlockSection;
    $arFields = [
        "ACTIVE" => 'Y',
        "IBLOCK_ID" => 462,
        "NAME" => $sectionName,
    ];
    $ID = $bs->Add($arFields);
    if ($ID < 0)
        dump($bs->LAST_ERROR);

    foreach ($services as $service) {
        $params = [
            'IBLOCK_ID' => 462,
            'IBLOCK_SECTION' => $ID,
            'type' => 'aspro_allcorp3_form',
            'NAME' => $service['name'],
            'PROPERTY_VALUES' => [
                'PRICE' => $service['price'],
            ]
        ];
        $iblock = new \CIBlockElement();
        $iblock_id = $iblock->Add($params);
        if ($iblock_id < 0)
            dump($iblock->LAST_ERROR);
    }
}

