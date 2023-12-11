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

<?php foreach ($arResult['ITEMS'] as $arItem): ?>
	<a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="documentation-block">
		<div class="documentation-block__img">
			<img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="img">
		</div>
		<div class="documentation-block__item">
			<div class="documentation-block__item-title">
				<?= $arItem['NAME'] ?>
			</div>
			<p class="documentation-block__item-text">
				<?= $arItem['PREVIEW_TEXT'] ?>
			</p>
		</div>
	</a>
<?php endforeach; ?>