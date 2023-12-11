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
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<section class="offer gallery-slider" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
		<div class="container">
			<h2 class="gallery__title-slider title">
				<?= $arItem['NAME'] ?>
			</h2>
			<div class="offer-slider">
				<?php foreach ($arItem['DISPLAY_PROPERTIES']['PHOTOS']['FILE_VALUE'] as $key => $file): ?>
					<div class="offer-slider__wrapper">
						<div class="offer-slider__item <?= ($key + 1) % 3 != 0 ? '' : 'offer-slider__item--big' ?>">
							<div class=" offer-slider__item-img">
								<img src="<?= $file['SRC'] ?>" alt="img">
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
<?php endforeach; ?>