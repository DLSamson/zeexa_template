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

use \Bitrix\Main\IO\File;

$includeFilesBasePath = SITE_TEMPLATE_PATH . "/including_areas/company/employees";

$itemsBySection = [];
foreach ($arResult['ITEMS'] as $arItem) {
	$itemsBySection[$arItem['IBLOCK_SECTION_ID']][] = $arItem;

	$filePath = $includeFilesBasePath . "/section_" . $arItem['IBLOCK_SECTION_ID'] . ".php";
	if (!File::isFileExists($_SERVER['DOCUMENT_ROOT'] . '/' . $filePath)) {
		file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/' . $filePath, '');
	}
}
$i = 0;
$getName = function ($i) {
	switch ($i) {
		case 0:
			return 'first';
		case 1:
			return 'second';
		case 2:
			return 'third';
		default:
			return 'fourth';
	}
}
	?>
<? foreach ($itemsBySection as $sectionId => $items): ?>
	<?
	$section = CIBlockSection::GetByID($sectionId)->GetNext();
	if (!$section)
		continue;
	?>
	<div class="team__slider">
		<h3>
			<?= $section['NAME'] ?>
		</h3>
		<p>
			<?= $section['DESCRIPTION'] ?>
		</p>
		<div class="swiper slider-<?= $getName($i); ?>">
			<div class="swiper-wrapper">
				<? foreach ($items as $arItem): ?>
					<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
					<a class="swiper-slide" href="<?= $arItem['DETAIL_PAGE_URL'] ?>"  id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
						<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" width="335" height="360" alt="" loading="lazy">
						<div class="card__content">
							<div class="card__title">
								<span><?= $arItem["NAME"] ?></span>
							</div>
							<div class="card__staff">
								<?= $arItem["PROPERTIES"]["POST"]["VALUE"] ?>
							</div>
						</div>
					</a>
				<? endforeach; ?>
			</div>
			<div class="swiper-pagination"></div>
		</div>
	</div>
<? endforeach; ?>