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
?>


<div class="about__inner">
	<div class="about__text">
		<? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/company/history/text.php') ?>
	</div>

	<div class="road-map">
		<? foreach ($arResult['ITEMS'] as $arItem): ?>
			<div class="road-map__item">
				<div class="road-map__year">
					<?= $arItem['NAME'] ?>
				</div>
				<div class="road-map__title">
					<p>
						<?= $arItem['PREVIEW_TEXT'] ?>
					</p>
				</div>
				<div class="road-map__info">
					<?= $arItem['DETAIL_TEXT'] ?>
				</div>
			</div>
		<? endforeach; ?>
	</div>

	<? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/company/history/image.php') ?>


</div>