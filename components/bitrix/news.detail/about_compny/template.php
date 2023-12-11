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

<section class="about-home">
	<div class="container">
		<div class="about-box home__box">
			<h2 class="about-box__title title">
				<?= $arResult["NAME"]; ?>
			</h2>
			<a href="<?= $arResult['DISPLAY_PROPERTIES']['URL']['VALUE']; ?>"
				class="about-box__link home__link">Подробнее</a>
		</div>

		<p class="about__subtitle subtitle">Мы работаем для Вас</p>
		<div class="about-block">
			<div class="about-block__content">
				<div class="about-block__text">
					<?= $arResult["FIELDS"]["PREVIEW_TEXT"]; ?>
				</div>
			</div>
			<div class="video">
				<img class="about-block__video" src="<?= $arResult["PREVIEW_PICTURE"]["SRC"]; ?>">
				<a class="video__link" href="<?= $arResult['DISPLAY_PROPERTIES']["VIDEO"]["FILE_VALUE"]['SRC']; ?>"
					target="_blank">
					<img src="<?= SITE_TEMPLATE_PATH ?>/img/home/play.png" alt="img">
				</a>
			</div>

		</div>
	</div>
</section>