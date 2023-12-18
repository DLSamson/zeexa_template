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

<section class="confidence">
	<div class="container">
		<div class="confidence-box home__box">
			<span href="#" class="confidence-box__title title">
				<? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/confidence/confidence_title.php'); ?>
			</span>
			<a href="<?= $arResult['LIST_PAGE_URL']; ?>" class="confidence-box__link home__link">Подробнее</a>
		</div>

		<div class="confidence-box__subtitle subtitle">
			<? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/confidence/confidence_subtitle.php'); ?>
		</div>

		<div class="confidence-slider">
			<? foreach ($arResult["ITEMS"] as $key => $arItem) : ?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>

				<div class="confidence-slider__wrapper" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
					<div class="confidence-slider__item">
						<div class="confidence-slider__box">
							<div class="confidence-slider__box-img">
								<img src="<?= $arItem['PREVIEW_PICTURE']['SRC']; ?>" alt="img">
							</div>
							<div class="confidence-slider__content">
								<div class="confidence-slider__content-title">
									<?= $arItem['NAME']; ?>
								</div>
								<p class="confidence-slider__content-text">
									<?= $arItem['PROPERTIES']['POST']['VALUE']; ?>
									·
									<?= $arItem['TIMESTAMP_X'] ?>
								</p>
								<div class="confidence-slider__content-img">
									<div class="rating" data-rating-readonly="true" data-rating-value="<?= $arItem['PROPERTIES']['RATING']['VALUE'] ?>" data-rating-stars="5"></div>
								</div>
							</div>
						</div>
						<p class="confidence-slider__text">
							<?= $arItem['FIELDS']['PREVIEW_TEXT']; ?>
						</p>
					</div>
				</div>

			<? endforeach; ?>
		</div>
	</div>
</section>