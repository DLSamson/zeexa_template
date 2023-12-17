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

<section class="contact">
	<div class="container">
		<? if ($arParams['SHOW_MAIN_TITLE']): ?>
			<h2 class="contact__title title">
				<? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/contacts/contacts_main_title.php'); ?>
			</h2>
			<div class="contact__subtitle subtitle">
				<? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/contacts/contacts_main_text.php'); ?>
			</div>
		<? endif; ?>

		<h3 class="contact-block__info-title--mobile title">
			<? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/contacts/contacts_title.php'); ?>
		</h3>
		<div class="contact-block">

			<div class="contact-block__map">
				<div id="map" class="contact-map"></div>
			</div>

			<div class="contact-block__info">
				<h3 class="contact-block__info-title title">Как нас найти </h3>
				<div class="contact-block__info-subtitle subtitle">
					<? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/contacts/contacts_subtitle.php'); ?>
				</div>

				<? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/contacts/contacts_addresses.php'); ?>

				<div class="contact-block__data">
					<div class="contact-block__data-item">
						<div class="contact-block__data-title">Телефон</div>
						<? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/contacts/contacts_phones.php'); ?>
					</div>

					<div class="contact-block__data-item">
						<div class="contact-block__data-title">E-mail</div>
						<? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/contacts/contacts_emails.php'); ?>
					</div>
				</div>

				<div class="contact-block__work">Режим работы</div>
				<div class="contact-block__time">
					<? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/contacts/contacts_time.php'); ?>
				</div>
				<div class="contact-block__button">
					<a class="contact-block__btn" href="#form-question" data-fancybox>Задать вопрос</a>
					<a class="contact-block__btn" href="#form-call" data-fancybox>Обратный звонок</a>
				</div>
			</div>
		</div>
	</div>
</section>