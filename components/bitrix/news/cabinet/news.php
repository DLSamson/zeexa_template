<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use Carbon\Carbon;
use App\Services\ApiService;
use function getApi;

$api = getApi();
$user = $api->getUser();
$maintances = $api->getUserMaintances();
$cars = $api->getUserCars();

if (!$user) {
	header('Location: /');
	setcookie(ApiService::TOKEN_NAME, '', time() - 3600);
}

$currentScreen = $_GET['screen'] ?? null;
?>

<section class="personal entry-page">
	<div class="container">
		<h1 class="personal__title">Личный кабинет</h1>
		<div class="personal-tabs">
			<div class="personal-tabs__item">
				<button class="personal-tabs__item-btn <?= $currentScreen == 'maintance' || !$currentScreen ? 'personal-tabs--active' : ''; ?>">Запись</button>
				<button class="personal-tabs__item-btn <?= $currentScreen == 'garage' ? 'personal-tabs--active' : ''; ?>">Гараж</button>
				<button class="personal-tabs__item-btn <?= $currentScreen == 'settings' ? 'personal-tabs--active' : ''; ?>">Настройки</button>
			</div>


			<div class="personal-tabs__content <?= $currentScreen == 'maintance' || !$currentScreen ? 'show' : 'hide'; ?>">
				<?php foreach ($maintances as $maintance) : ?>
					<?php $car = $maintance->car; ?>
					<a href="#maintance-<?= $maintance->id; ?>" data-fancybox="" class="entry-page__inner">
						<div class="entry-page__box">
							<span><?= Carbon::parse($maintance->appointmentTime)->format('d.m'); ?></span>
							<span><?= Carbon::parse($maintance->appointmentTime)->format('H:i'); ?></span>
						</div>
						<div class="entry-page__block">
							<span class="entry-page__block-marka">
								<?= $car->carSerial->carModel->brand->name; ?> /
								<?= $car->carSerial->carModel->name; ?> /
								<?= $car->carSerial->name; ?>
							</span>

							<span class="entry-page__block-to">
								<?= $maintance->userDescription; ?>
							</span>

							<span class="entry-page__block-adrress">
								<?= $maintance->office->address; ?>
							</span>
						</div>
					</a>

					<div class="hidden">
						<?= render('maintance_form.php', ['maintance' => $maintance]) ?>
					</div>
				<?php endforeach; ?>


				<button href="#form-add-maintance-car" data-fancybox class="entry__btn entry-page__btn">Записаться на СТО</button>
			</div>

			<div class="personal-tabs__content <?= $currentScreen == 'garage' ? 'show' : 'hide'; ?>">
				<?php foreach ($cars as $key => $car) : ?>
					<a href="#car-<?= $car->id; ?>" data-fancybox class="entry-page__inner">
						<div class="entry-page__block">
							<span class="entry-page__block-marka">
								<?= $car->carSerial->carModel->brand->name; ?> /
								<?= $car->carSerial->carModel->name; ?> /
								<?= $car->carSerial->name; ?>
							</span>
							<span class="entry-page__block-to">Гос номер: <?= $car->govNumber; ?></span>
						</div>
					</a>

					<div class="hidden">
						<form class="ajax-form car-form" id="car-<?= $car->id; ?>">
							<div class="entry-page__block-marka">
								<?= $car->carSerial->carModel->brand->name; ?> /
								<?= $car->carSerial->carModel->name; ?> /
								<?= $car->carSerial->name; ?>
							</div>
							<p>Гос номер: <?= $car->govNumber; ?></p>

							<div class="fields">
								<? if (count(collect($maintances)->filter(fn ($maintance) => $maintance->car->id === $car->id)->toArray()) === 0): ?>
									<p>Записи отсутствуют</p>
								<? endif; ?>


								<?php foreach ($maintances as $maintance) : ?>
									<?php if ($car->id !== $maintance->car->id)
										continue; ?>
									<a href="#maintance-<?= $maintance->id; ?>" data-fancybox="" class="entry-page__inner">
										<div class="entry-page__box">
											<span><?= Carbon::parse($maintance->appointmentTime)->format('d.m'); ?></span>
											<span><?= Carbon::parse($maintance->appointmentTime)->format('H:i'); ?></span>
										</div>
										<div class="entry-page__block">
											<span class="entry-page__block-marka">
												<?= $car->carSerial->carModel->brand->name; ?> /
												<?= $car->carSerial->carModel->name; ?> /
												<?= $car->carSerial->name; ?>
											</span>

											<span class="entry-page__block-to">
												<?= $maintance->userDescription; ?>
											</span>

											<span class="entry-page__block-adrress">
												<?= $maintance->office->address; ?>
											</span>
										</div>
									</a>
								<?php endforeach; ?>
							</div>

							<a href="#form-add-maintance-services" data-add-maintance-car data-fancybox data-car-id="<?= $car->id; ?>" class="expect__btn button">
								Записаться на СТО
							</a>
						</form>
					</div>
				<?php endforeach; ?>
				<button data-fancybox href="#form-add-car" class="entry__btn entry-page__btn">Добавить машину</button>
			</div>

			<div class="personal-tabs__content <?= $currentScreen == 'settings' ? 'show' : 'hide'; ?>">
				<button data-fancybox href="#form-sms-info" class="entry__btn entry-page__btn">Обновить данные профиля</button>
			</div>
		</div>
	</div>
</section>