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
$itemsBySection = [];
foreach ($arResult['ITEMS'] as $arItem) {
	$itemsBySection[$arItem['IBLOCK_SECTION_ID']][] = $arItem;
}
?>

<form class="popular-marks" data-services data-spoilers>
	<?php foreach ($itemsBySection as $sectionId => $arItems): ?>
		<?
		$section = CIBlockSection::GetByID($sectionId)->GetNext();
		if (!$section)
			continue;
		?>

		<div class="stock-item" data-spoiler>

			<div class="stock-item__header" data-spoiler-control>
				<div class="stock-item__content">
					<div class="stock-item__title">
						<?= $section['NAME'] ?>
					</div>
				</div>

				<div class="stock-item__arrow">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
						<path d="M3 6L8 11L13 6" stroke-width="2.46154" stroke-linecap="round" stroke-linejoin="round">
						</path>
					</svg>
				</div>
			</div>

			<div class="stock-item__main" data-spoiler-content>
				<div class="stock-item__wrap" data-service-items>
					<?php foreach ($arItems as $arItem): ?>
						<?
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						?>

						<div class="stock-item__item" data-service-item id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
							<label>
								<input type="checkbox" name="service" value="<?= $arItem['NAME']; ?>" data-id="<?= $arItem['ID']; ?>">
								<div>
									<?= $arItem['NAME']; ?>
								</div>
							</label>
							<div class="stock-item__price">
								<div>
									<?= $arItem['PROPERTIES']['PRICE']['VALUE']; ?> ₽
								</div>
								<div class="stock-item__item-select-btn">Выбрать</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</form>