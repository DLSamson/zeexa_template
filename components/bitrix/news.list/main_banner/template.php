<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$arResult['ITEMS'] = collect($arResult['ITEMS'])->filter(fn($item) => $item['IBLOCK_SECTION_ID'] == 594);
?>


<?php foreach ($arResult['ITEMS'] as $arItem): ?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="swiper-slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
		<img src="<?= $arItem['DETAIL_PICTURE']['SRC'] ?? SITE_TEMPLATE_PATH . '/img/home/home-bg-1.jpg' ?>" width="1920"
			height="" alt="" loading="lazy">


		<div class="container-dem container--main">
			<div class="header-section__content">
				<h1 class="header-section__title"><?= $arItem['~NAME'] ?></h1>
				<p class="header-section__subtitle"><?= $arItem['PREVIEW_TEXT'] ?></p>
				<!-- <div class="header-section__menu">
					<div class="header-section__menu-item">
						<p class="menu-item__title"> Выберите адрес</p>
						<p class="menu-item__info"> ул. Автозаводская, д. 16</p>
					</div>
					<div class="header-section__menu-item">
						<p class="menu-item__title"> Выберите дату</p>
						<p class="menu-item__info">Четверг 19</p>
					</div>
					<div class="header-section__menu-item">
						<p class="menu-item__title"> Выберите время</p>
						<p class="menu-item__info">12:00</p>
					</div>
					<div class="header-section__menu-item">
						<form class="header-section__form">
							<input type="text" name="header-form" placeholder="Укажите номер телефона">
							<button class="btn btn--long">Записаться</button>
						</form>
					</div>
				</div> -->
			</div>
		</div>
	</div>
<?php endforeach; ?>