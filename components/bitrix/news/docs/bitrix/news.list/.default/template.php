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
// dump($arResult, $arResult['SECTIONS']);
$itemsBySection = [];
foreach ($arResult['ITEMS'] as $arItem) {
	$itemsBySection[$arItem['IBLOCK_SECTION_ID']][] = $arItem;
}
?>


<? foreach ($itemsBySection as $sectionId => $items): ?>
	<?
	$section = CIBlockSection::GetByID($sectionId)->GetNext();
	?>
	<div class="documentation__title about-tabs__title">
		<?= $section['NAME'] ?>
	</div>
	<div class="documentation__subtitle subtitle">
		<?= $section['DESCRIPTION'] ?>
	</div>

	<? foreach ($items as $arItem): ?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="documentation-block" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
			<div class="documentation-block__img">
				<img src="<?= SITE_TEMPLATE_PATH ?>/img/icon/document.svg" alt="img">
			</div>
			<a class="documentation-block__item" data-hystmodal="#doc-<?= $arItem['ID'] ?>" href="#">
				<div class="documentation-block__item-title">
					<?= $arItem['NAME'] ?>
				</div>
				<p class="documentation-block__item-text">
					<?= $arItem['PREVIEW_TEXT'] ?>
				</p>
			</a>
		</div>


		<div style="display:block;">
			<div class="hystmodal" id="doc-<?= $arItem['ID'] ?>" aria-hidden="true">
				<div class="hystmodal__wrap">
					<div class="hystmodal__window" role="dialog" aria-modal="true">
						<button data-hystclose class="hystmodal__close">Закрыть</button>
						<img src="<?= $arItem['DISPLAY_PROPERTIES']['DOCUMENT']['FILE_VALUE']['SRC'] ?>" alt=""
							style="margin: 40px auto; border:1px solid #ccc;">
					</div>
				</div>
			</div>
		</div>
	<? endforeach; ?>
<? endforeach; ?>