<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
require_once __DIR__ . '/vendor/autoload.php';
if (!defined('CURRENT_URI'))
	define('CURRENT_URI', $APPLICATION->GetCurUri());

use App\Services\ApiService;
$api = getApi();
$user = $api->getUser();

?>
<!DOCTYPE html>
<html>

<head>
	<title>
		<?= $APPLICATION->showTitle(); ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">

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
	\Bitrix\Main\Page\Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/nice-select.css');
	\Bitrix\Main\Page\Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/update.css');


	$APPLICATION->ShowCSS(true, $bXhtmlStyle);
	$APPLICATION->ShowHeadStrings();
	$APPLICATION->ShowHeadScripts();
	?>
</head>

<body>
	<?php include_once str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'] . '/include/header/body_above_counter.php'); ?>
	<div id="panel">
		<? $APPLICATION->showPanel(); ?>
	</div>

	<div class="side_panel">
		<a data-fancybox href="#form-call">
			<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path
					d="M17.7071 0.292893C17.3166 -0.0976311 16.6834 -0.0976311 16.2929 0.292893L12 4.58579V2C12 1.44772 11.5523 1 11 1C10.4477 1 10 1.44772 10 2V7C10 7.55228 10.4477 8 11 8H16C16.5523 8 17 7.55228 17 7C17 6.44772 16.5523 6 16 6H13.4142L17.7071 1.70711C18.0976 1.31658 18.0976 0.683417 17.7071 0.292893Z"
					fill="#999999" />
				<path fill-rule="evenodd" clip-rule="evenodd"
					d="M9.45837 10.1943C10.0193 9.90519 10.6678 9.83553 11.2766 9.99668C11.7686 10.1373 13.383 10.4586 13.6848 10.504C14.0411 10.5431 14.3855 10.6553 14.6962 10.8336C15.037 11.0293 15.3282 11.2993 15.5479 11.6232C15.7676 11.947 15.9104 12.3167 15.9648 12.7044C16.0723 13.472 15.9295 14.4796 15.5919 15.1722C15.4003 15.5653 15.131 15.9157 14.8004 16.2028C14.3305 16.6665 13.8052 17.0705 13.2365 17.406C12.5538 17.8087 11.7909 17.965 11 17.9947C10.3097 18.0205 9.61692 17.9522 8.9414 17.7901C8.46237 17.6752 7.99728 17.5144 7.55237 17.3108C6.0886 16.641 4.70442 15.5362 3.57761 14.4062C3.2239 14.0515 2.88851 13.6788 2.57283 13.2895C1.88246 12.4382 1.18825 11.4945 0.721163 10.5C0.499865 10.0288 0.326886 9.53509 0.205848 9.0262C0.0475786 8.36078 -0.0195372 7.67928 0.00488923 7C0.0324595 6.23329 0.174242 5.47907 0.560547 4.81296C0.899657 4.22822 1.31141 3.6875 1.78657 3.20363C2.07322 2.87026 2.42573 2.59831 2.82271 2.40478C3.54837 2.05101 4.61504 1.90807 5.41264 2.0606C5.79206 2.13315 6.15002 2.28876 6.46071 2.5156C6.77144 2.74248 7.02749 3.03523 7.21016 3.37263C7.36243 3.6539 7.46051 3.96033 7.49994 4.27616C7.53342 4.44373 7.56477 4.60178 7.59461 4.75227L7.59483 4.75336C7.7468 5.51968 7.85991 6.09003 8.01911 6.72308C8.17982 7.31931 8.11405 7.95524 7.83091 8.50833C7.6753 8.81231 7.46044 9.07869 7.2018 9.2939C7.40474 9.59367 7.63396 9.87594 7.88714 10.1373C8.13674 10.3813 8.40634 10.6033 8.69279 10.8011C8.90384 10.5534 9.16313 10.3464 9.45837 10.1943ZM9.32406 13.0949C9.14936 13.164 8.95399 13.1617 8.78045 13.0885C7.93174 12.6957 7.15753 12.1601 6.49221 11.5054C5.83857 10.835 5.30536 10.0586 4.91589 9.21005C4.84325 9.03742 4.8405 8.84386 4.9082 8.66977C5.00378 8.42394 5.23682 8.28381 5.45809 8.15076C5.5032 8.12364 5.54782 8.0968 5.59069 8.06943C5.78916 7.94269 5.9931 7.80177 6.08277 7.62661C6.14765 7.49986 6.16171 7.35326 6.1221 7.21627C5.94697 6.52267 5.82177 5.89099 5.66728 5.11152L5.6665 5.10757C5.63208 4.93392 5.59621 4.75294 5.558 4.5623C5.55338 4.4685 5.52773 4.37682 5.48288 4.29398C5.43804 4.21114 5.37514 4.13923 5.29881 4.08349C5.22248 4.02776 5.13464 3.98961 5.04169 3.97183C4.64894 3.89673 4.03467 3.9824 3.68716 4.15182C3.51407 4.2362 3.36248 4.35827 3.24367 4.50896C2.91027 4.8403 2.61664 5.20799 2.36811 5.60466C2.12593 5.99119 2.0219 6.32681 1.98217 6.78256C1.92985 7.38275 1.97399 7.9892 2.11426 8.57897C2.20476 8.95946 2.33424 9.32865 2.5 9.68099C2.91983 10.5734 3.56867 11.4306 4.19615 12.1858C4.51863 12.5739 4.864 12.9424 5.23032 13.2895C6.09773 14.1113 7.13105 14.9287 8.2091 15.4648C8.58788 15.6532 8.98802 15.7989 9.40212 15.8982C10.036 16.0503 10.69 16.0909 11.3346 16.0194C11.7399 15.9745 12.0335 15.8619 12.3791 15.6449C12.7745 15.3966 13.1403 15.1037 13.469 14.7715C13.6201 14.6506 13.7422 14.4979 13.8268 14.3244C14.0002 13.9688 14.0766 13.358 14.0226 12.9726C14.0094 12.8787 13.9748 12.789 13.9214 12.7103C13.868 12.6316 13.7973 12.566 13.7146 12.5185C13.6318 12.4711 13.5393 12.4429 13.4441 12.4363C13.2069 12.4012 10.9927 12.0053 10.7713 11.8773C10.6339 11.841 10.4879 11.8568 10.3619 11.9217C10.1836 12.0136 10.0406 12.2223 9.91175 12.4229C9.88365 12.4667 9.85618 12.5123 9.82841 12.5585C9.69873 12.7741 9.56252 13.0006 9.32406 13.0949Z"
					fill="#999999" />
			</svg>
		</a>
		<a data-fancybox href="#form-review">
			<svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path
					d="M10 8.45994V9.5C10 10.3284 10.6716 11 11.5 11H12.5C13.3284 11 14 10.3284 14 9.5V5.36498C14 5.16341 13.8366 5 13.635 5C13.5479 5 13.4636 5.03117 13.3975 5.08787L10.3492 7.70068C10.1276 7.89066 10 8.16801 10 8.45994Z"
					fill="#999999" />
				<path
					d="M5 9.5V8.45994C5 8.16801 5.12756 7.89066 5.34921 7.70068L8.39749 5.08787C8.46364 5.03117 8.54789 5 8.63502 5C8.83659 5 9 5.16341 9 5.36498V9.5C9 10.3284 8.32843 11 7.5 11H6.5C5.67157 11 5 10.3284 5 9.5Z"
					fill="#999999" />
				<path fill-rule="evenodd" clip-rule="evenodd"
					d="M0.000216186 4C0.000216603 1.79086 1.79108 0 4.00022 0H15.0002C17.2094 0 19.0002 1.79086 19.0002 4V12C19.0002 14.2091 17.2094 16 15.0002 16H5.38608L2.50779 18.6098C1.54378 19.4839 0.000213623 18.7999 0.000213623 17.4986L0.000216186 4ZM4.00022 2C2.89565 2 2.00022 2.89543 2.00022 4L2.00021 16.3703L4.04265 14.5184C4.41057 14.1848 4.88944 14 5.38608 14H15.0002C16.1048 14 17.0002 13.1046 17.0002 12V4C17.0002 2.89543 16.1048 2 15.0002 2H4.00022Z"
					fill="#999999" />
			</svg>
		</a>
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

			<a href="<?= $user ? '/login' : '#form-sms' ?>" <?= !$user ? 'data-fancybox' : '' ?> class="header_auth-icon">
				<img class="user-icon" src="<?= SITE_TEMPLATE_PATH ?>/img/icon/user.svg" width="24" height="24" alt="" loading="lazy">
			</a>

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

			<? $user = getApi()->getUser(); ?>
			
			<? if($user): ?>
				<a class="header__user" href="/login">
					<div class="header__user-avatar"><?= mb_substr($user->name, 0, 1); ?></div>
					<div class="header__user-name"><?= $user->name ?></div>
					<div class="header__user-arrow">
						<img src="<?= SITE_TEMPLATE_PATH ?>/img/icon/arrows-select.svg" alt="">
					</div>
				</a>
			<? else: ?>
				<a 
				href="" 
				class="btn btn--long"
				data-login-button
				>
					Войти
				</a>
			<? endif; ?>
			
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

		<?= render('header_form.php') ?>

		<a href="#form-lead" data-fancybox="" class="header-button">Записаться</a>


	</div>

	<main class="main">