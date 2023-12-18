<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
require_once __DIR__ . '/vendor/autoload.php';
if (!defined('CURRENT_URI'))
    define('CURRENT_URI', $APPLICATION->GetCurUri());
?><!DOCTYPE html>
<html>

<head>
    <title>
        <?= $APPLICATION->showTitle(); ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $APPLICATION->ShowMeta("viewport");
    $APPLICATION->ShowMeta("HandheldFriendly");
    $APPLICATION->ShowMeta("apple-mobile-web-app-capable", "yes");
    $APPLICATION->ShowMeta("apple-mobile-web-app-status-bar-style");
    $APPLICATION->ShowMeta("SKYPE_TOOLBAR");

    \Bitrix\Main\Page\Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/jquery.fancybox.min.css');
    \Bitrix\Main\Page\Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/style.min.css');
    \Bitrix\Main\Page\Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/swiper-bundle.css');
    \Bitrix\Main\Page\Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/hystmodal.min.css');
    \Bitrix\Main\Page\Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/update.css');
    // \Bitrix\Main\Page\Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/font-awesome.min.css');

    $APPLICATION->ShowCSS(true, $bXhtmlStyle);
    $APPLICATION->ShowHeadStrings();
    $APPLICATION->ShowHeadScripts();
    ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>
    <div id="panel">
        <? $APPLICATION->showPanel(); ?>
    </div>

    <div class="header-section">


        <header class="header">

            <div class="logo">
                <a href="/">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/icon/logo.svg" width="127" height="40" alt="Лого"
                        loading="lazy">
                </a>
            </div>

            <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/header/header_main-phone.php'); ?>

            <img class="user-icon" src="<?= SITE_TEMPLATE_PATH ?>/img/icon/user.svg" width="24" height="24" alt=""
                loading="lazy">

            <button class="cmn-toggle-switch cmn-toggle-switch__htx" id="menu__button">
                <span>toggle menu</span>
            </button>

            <? $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "header",
                array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "left",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "1",
                    "MENU_CACHE_GET_VARS" => array(
                    ),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "top",
                    "USE_EXT" => "N",
                    "COMPONENT_TEMPLATE" => "header"
                ),
                false
            ); ?>

            <!-- <a href="/" class="btn btn--long">Войти</a> -->
        </header>

		<? $APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"main_banner",
			array(
				"ACTIVE_DATE_FORMAT" => "j M Y",
				"ADD_SECTIONS_CHAIN" => "N",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "Y",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"CHECK_DATES" => "Y",
				"COMPONENT_TEMPLATE" => "main_banner",
				"DETAIL_URL" => "",
				"DISPLAY_BOTTOM_PAGER" => "Y",
				"DISPLAY_DATE" => "N",
				"DISPLAY_NAME" => "N",
				"DISPLAY_PICTURE" => "N",
				"DISPLAY_PREVIEW_TEXT" => "N",
				"DISPLAY_TOP_PAGER" => "N",
				"FIELD_CODE" => array(
					0 => "NAME",
					1 => "PREVIEW_TEXT",
					2 => "PREVIEW_PICTURE",
					3 => "DETAIL_TEXT",
					4 => "DETAIL_PICTURE",
					5 => "",
				),
				"FILTER_NAME" => "arFrontFilter",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"IBLOCK_ID" => "201",
				"IBLOCK_TYPE" => "aspro_allcorp3_adv",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"INCLUDE_SUBSECTIONS" => "N",
				"MESSAGE_404" => "",
				"NEWS_COUNT" => "30",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => "ajax",
				"PAGER_TITLE" => "",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"PREVIEW_TRUNCATE_LEN" => "",
				"PROPERTY_CODE" => array(
					0 => "",
					1 => "LINK",
					2 => "TYPE",
					3 => "TIZER_ICON",
					4 => "",
				),
				"SET_BROWSER_TITLE" => "N",
				"SET_LAST_MODIFIED" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_STATUS_404" => "N",
				"SET_TITLE" => "N",
				"SHOW_404" => "N",
				"SORT_BY1" => "SORT",
				"SORT_BY2" => "ID",
				"SORT_ORDER1" => "ASC",
				"SORT_ORDER2" => "ASC",
				"STRICT_SECTION_CHECK" => "N"
			),
			false
		); ?>
        <?php /* 
        <div class="header-block">
            <form action="#" class="header-form">
                <select name="" id="" class="header-form__select">
                    <option value="" class="header-form__option">Выберите адрес</option>
                    <option value="" class="header-form__option">ул. Авто, д. 100</option>
                    <option value="" class="header-form__option">ул. Авто, д. 100</option>
                </select>
                <select name="" id="" class="header-form__select">
                    <option value="" class="header-form__option">Выберите дату</option>
                    <option value="" class="header-form__option">Четверг 19</option>
                    <option value="" class="header-form__option">Среда 19</option>
                </select>
                <select name="" id="" class="header-form__select">
                    <option value="" class="header-form__option">Выберите время</option>
                    <option value="" class="header-form__option">12:00</option>
                    <option value="" class="header-form__option">11:00</option>
                </select>

                <input type="text" class="header-form__input" placeholder="Укажите номер телефона">
                <button class="header-form__btn">Записаться</button>
            </form>
            <button class="btn btn--long btn--long-mobile">Записаться</button>
        </div> */?>
    </div>

    <main class="main">