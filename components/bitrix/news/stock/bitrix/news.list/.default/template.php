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
	<div class="stock-item" data-spoiler>

		<div class="stock-item__header" data-spoiler-control>
			<div class="stock-item__media">
				<div class="stock-item__image">
					<img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" class="img-fluid" alt="">
				</div>
			</div>
			<div class="stock-item__content">
				<div class="stock-item__title">
					<?= $arItem['NAME'] ?>
				</div>
				<div class="stock-item__description">
					<?= $arItem['PREVIEW_TEXT'] ?>
				</div>
			</div>
			<div class="stock-item__arrow">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
					<path d="M3 6L8 11L13 6" stroke-width="2.46154" stroke-linecap="round" stroke-linejoin="round"></path>
				</svg>
			</div>
		</div>

		<div class="stock-item__main" data-spoiler-content>
			<div class="stock-item__wrap">
				<?= $arItem['DETAIL_TEXT'] ?>
				<!-- <div class="stock-item__description">
					Заменим бесплатно масло заказанное нами и при надобности сделаем диагностику за 1 рубль +
					дадим гарантию на все работы 6 месяцев!
				</div>
				<div class="stock-item__title">Условия проведения акции</div>
				<div class="stock-item__text">
					<ul>
						<li>Сдача автомобиля на техническое обслуживание в техцентр НИВЮС</li>
						<li>Покупка нашего масла</li>
					</ul>
				</div> -->
			</div>
		</div>
	</div>
<?php endforeach; ?>