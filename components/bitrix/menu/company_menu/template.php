<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die(); ?>

<div class="about-tabs__item">
	<? foreach ($arResult as $arItem): ?>
		<a href="<?= $arItem["LINK"] ?>" class="about-tabs__item-btn <?= $arItem["SELECTED"] ? 'tabs-active' : '' ?>">
			<?= $arItem["TEXT"] ?>
		</a>
	<? endforeach ?>
</div>