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

<section class="stock">
	<div class="container">
		<div class="stock-box home__box">
			<span class="stock-box__title 	title">
				<? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/stock/stock_title.php'); ?>
			</span>
			<a href="<?= $arResult['LIST_PAGE_URL']; ?>" class="stock-box__link home__link">
				Подробнее
			</a>
		</div>
		<div class="stock-box__subtitle subtitle">
			<? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/stock/stock_subtitle.php'); ?>
		</div>

		<div class="card-block">
			<div class="swiper card-slider" data-items>
				<div class="swiper-wrapper">
					<? foreach ($arResult["ITEMS"] as $key => $arItem): ?>
						<?
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						?>
						<div class="swiper-slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
							<a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"
								class="card <?= ($key) % 3 == 0 ? 'card--xl' : '' ?>">
								<div class="card__media">
									<img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" class="img-cover" alt="">
								</div>
								<div class="card__content">
									<div class="card__title">
										<span>
											<?= $arItem['NAME'] ?>
										</span>
										<i>
											<svg xmlns="http://www.w3.org/2000/svg" class="ico-svg" viewBox="0 0 16 16"
												fill="none">
												<path d="M6 13L11 8L6 3" stroke-width="2.46154" stroke-linecap="round"
													stroke-linejoin="round" />
											</svg>
										</i>
									</div>
									<div class="card__text">
										<?= ($key) % 3 == 0 ? $arItem['PREVIEW_TEXT'] : '' ?>
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