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

$arResult['ITEMS'] = collect($arResult['ITEMS'])
	->toArray();

function getSvgIcon($path) {
	return file_get_contents($_SERVER['DOCUMENT_ROOT'].'/'.$path);
}

?>
<section class="advantages">
	<div class="container">
		<h3 class="advantages__title title">
			<? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/advantages/advantages_title.php'); ?>
		</h3>
		<div class="advantages__subtitle subtitle">
			<? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/advantages/advantages_subtitle.php'); ?>
		</div>


		<div class="advantages-block">
			<? foreach ($arResult["ITEMS"] as $arItem): ?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<div class="advantages-block__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
					<div class="advantages-block__item-img" style="display: flex; justify-content: center;">
						<?= getSvgIcon($arItem["DISPLAY_PROPERTIES"]["TIZER_ICON"]["FILE_VALUE"]['SRC']) ?>
					</div>

					<div class="advantages-block__item-title">
						<?= $arItem["NAME"] ?>
					</div>

					<?= $arItem["DETAIL_TEXT"] ?>
					<!-- <p class="advantages-block__item-text"></p> -->
				</div>

			<? endforeach; ?>
		</div>

		<p class="advantages__text">
			<? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/advantages/advantages_text.php'); ?>
		</p>
	</div>
</section>