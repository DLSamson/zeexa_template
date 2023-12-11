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
	<div class="reviews-block" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
		<div class="reviews-block__top">
			<div class="reviews-block__img">
				<img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="img">
			</div>
			<div class="reviews-block__inner">
				<div class="reviews-block__item">
					<div class="reviews-block__item-title">
						<?= $arItem['NAME'] ?>
					</div>
					<div class="reviews-block__item-text">
						<?= $arItem['PROPERTIES']['POST']['VALUE'] ?> ·
						<span>
							<?= date('d.m.Y', strtotime($arItem['DATE_ACTIVE_FROM'])) ?>
						</span>
					</div>
				</div>
				<div class="reviews-block__rate">
					<img src="<?= SITE_TEMPLATE_PATH ?>/img/home/reviews-rate.jpg" alt="img">
				</div>
			</div>

		</div>
		<div class="reviews-block__bottom">
			<?= $arItem['PREVIEW_TEXT'] ?>
		</div>
	</div>
<?php endforeach; ?>