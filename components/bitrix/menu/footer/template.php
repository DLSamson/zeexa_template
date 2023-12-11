<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die(); ?>

<ul class="footer__menu">
	<? foreach ($arResult as $arItem): ?>
		<li class="footer__menu-item">
			<a href="<?= $arItem["LINK"] ?>" class="footer__menu-link">
				<?= $arItem["TEXT"] ?>
			</a>
		</li>
	<? endforeach ?>
</ul>