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

<div class="swiper slider-main" data-items-main>
	<div class="swiper-wrapper">
		<?php foreach ($arResult['ITEMS'] as $arItem): ?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="swiper-slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
				<img src="https://nivus.ru/upload/iblock/83b/5d6b5sqeztw3gmz1a17ymdos7f82v9q6.jpg" width="1920"
					height="" alt="" loading="lazy">
		
				<div class="container-dem container--main">
					<div class="header-section__content">
						<h1 class="header-section__title"><?= $arItem['~NAME'] ?></h1>
						<p class="header-section__subtitle"><?= $arItem['PREVIEW_TEXT'] ?></p>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<div class="swiper-pagination"></div>
</div>