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

<section class="employees">
	<div class="container">
		<div class="employees-box home__box">
			<h2 class="employees-box__title title">
				<?= $arParams['TITLE']; ?>
			</h2>
			<? if ($arParams['DISPLAY_MORE_BUTTON'] == 'Y'): ?>
				<a href="<?= $arResult['LIST_PAGE_URL']; ?>" class="employees-box__link home__link">
					Подробнее
				</a>
			<? endif; ?>
		</div>
		<div class="employees-box__subtitle subtitle">
			<?= $arParams['SUBTITLE']; ?>
		</div>

		<div class="card-block">
			<div class="swiper card-slider" data-items>
				<div class="swiper-wrapper">
					<? foreach ($arResult['ITEMS'] as $arItem): ?>
						<?
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						?>
						<div class="swiper-slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
							<a href="<?= $arItem['DETAIL_PAGE_URL']; ?>" class="card">

								<div class="card__media">
									<img src="<?= $arItem['PREVIEW_PICTURE']['SRC']; ?>" class="img-cover" alt="">
								</div>

								<div class="card__content">
									<div class="card__content">
										<div class="card__title">
											<span>
												<?= $arItem['NAME']; ?>
											</span>
										</div>
										<div class="card__staff">
											<?= $arItem['PROPERTIES']['POST']['VALUE']; ?>
										</div>
									</div>
								</div>

							</a>
						</div>

					<? endforeach; ?>
				</div>
				<div class="swiper-pagination" data-items-pagination></div>
			</div>
		</div>
	</div>
</section>