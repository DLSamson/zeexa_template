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

<? foreach ($arResult['ITEMS'] as $arItem): ?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<form class="questions__wrapper" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
		<div class="questions-accardion__btn">
			<div class="questions-accardion__wrapper">
				<div class="questions-accardion__block">
					<span class="questions-accardion__title">
						<?= $arItem['NAME']; ?>
					</span>
					<span class="questions-accardion__subtitle">
						Опыт работы:
						<?= $arItem['PROPERTIES']['QUALITY']['VALUE']; ?>
					</span>
				</div>
				<div class="questions-accardion__block-price">
					<?= $arItem['PROPERTIES']['PAY']['VALUE']; ?>
				</div>
			</div>
		</div>
		<div class="questions-accardion__content">
			<?= $arItem['DETAIL_TEXT']; ?>
			<a class="vacancies-block__btn button" data-fancybox href="#form-vacancy">Отправить резюме</a>
		</div>
	</form>
<? endforeach; ?>