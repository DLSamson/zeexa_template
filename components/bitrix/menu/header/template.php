<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die(); ?>

<ul class="nav" role="menu">
	<? foreach ($arResult as $arItem): ?>
		<li class="menuitem <?= $arItem["SELECTED"] ? 'menuitem--active' : '' ?>" role="menuitem">
			<a href="<?= $arItem["LINK"] ?>">
				<?= $arItem["TEXT"] ?>
			</a>
		</li>
	<? endforeach ?>

	<div class="nav-bottom">
		<p>Технический центр НИВЮС расположен по адресу:</p>
		<ul>
			<? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/header/header_places.php'); ?>
		</ul>
		<div class="contacts-wrap">
			<div class="phone-block">
				<p>Телефон</p>
				<ul>
					<? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/header/header_contacts.php'); ?>
				</ul>
			</div>
			<div class="email-block">
				<p>E-mail</p>
				<ul>
					<? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/header/header_email.php'); ?>
				</ul>
			</div>
		</div>
		<p class="time">
			<? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/header/header_working_hours.php'); ?>
		</p>
		<button class="btn btn--long btn--mobile">Обратный звонок</button>
		<button class="btn btn--long btn--transparent btn--mobile">Задать вопрос</button>
	</div>

</ul>