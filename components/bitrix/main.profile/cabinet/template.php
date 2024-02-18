<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use Carbon\Carbon;
use App\Services\ApiService;
use App\Services\MaintanceStatus;
use function getApi;

$api = getApi();

$user = $api->getUser();

$maintances = $api->getUserMaintances();
$cars = $api->getUserCars();

if (!$user) {
	// header('Location: /');
	// setcookie(ApiService::TOKEN_NAME, '', time() - 3600);
}

Carbon::setLocale('ru');

?>

<section class="personal entry-page">
	<div class="container">
		<h1 class="personal__title">Личный кабинет</h1>
		<div class="personal-tabs">
			<div class="personal-tabs__item">
				<button class="personal-tabs__item-btn">Запись</button>
				<button class="personal-tabs__item-btn">Гараж</button>
				<button class="personal-tabs__item-btn">Настройки</button>
			</div>


			<div class="personal-tabs__content">
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
						<form class="ajax-form maintance-form" id="maintance-<?= $maintance->id; ?>">
							<div class="center fit-content maintance-status-icon">
								<img src="<?= SITE_TEMPLATE_PATH ?>/img/icon/
									<?= $maintance->status === ApiService::UNDER_MAINTANCE
										? 'big_working.png'
										:  'big_check.png'
									?>" alt="">
							</div>

							<div class="center fit-content maintance-status-message">
								<?= $maintance->status === ApiService::UNDER_MAINTANCE
									? 'Обслуживание'
									: 'Вы записаны' ?>
							</div>

							<div class="center fit-content maintance-status-time">
								<?= Carbon::parse($maintance->appointmentTime)->format('l, j F на H:i'); ?>
							</div>

							<div class="center fit-content maintance-status-address">
								<?= $maintance->office->address; ?>
							</div>

							<div height="300px" width="100%" id="map-maintance-<?= $maintance->id; ?>" class="maintance-maps" data-latitude="<?= $maintance->office->coordinateX; ?>" data-longitude="<?= $maintance->office->coordinateY; ?>" data-title="<?= $maintance->office->address; ?>" data-id="map-maintance-<?= $maintance->id; ?>"></div>

							<div class="fields">
								<label>
									<span>Автомобиль</span>
									<a href="#car-<?= $car->id; ?>" data-car-id="<?= $car->id; ?>" class="entry-page__inner">
										<div class="entry-page__block">
											<span class="entry-page__block-marka">
												<?= $car->carSerial->carModel->brand->name; ?> /
												<?= $car->carSerial->carModel->name; ?> /
												<?= $car->carSerial->name; ?>
											</span>
											<span class="entry-page__block-to">Гос номер: <?= $car->govNumber; ?></span>
										</div>
									</a>
								</label>

								<? if ($maintance->services) : ?>
									<label>
										<span>Услуги</span>
										<? foreach ($maintance->services as $service) : ?>
											<div><?= $service->name; ?></div>
										<? endforeach; ?>
									</label>
								<? endif; ?>


								<? if ($maintance->userDescription) : ?>
									<label>
										<span>Комментарий</span>
										<div><?= $maintance->userDescription; ?></div>
									</label>
								<? endif; ?>
							</div>

							<!-- <button class="sms__btn button mb-2">Перенести</button> -->

							<!-- <div class="button-inverted center fit-content" data-maintance-cancel="<?= $maintance->id; ?>">Отменить</div> -->
						</form>
					</div>
				<?php endforeach; ?>


				<button href="#form-add-maintance-car" data-fancybox class="entry__btn entry-page__btn">Записаться на СТО</button>
			</div>

			<div class="personal-tabs__content">
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
						</form>
					</div>
				<?php endforeach; ?>
				<button data-fancybox href="#form-add-car" class="entry__btn entry-page__btn">Добавить машину</button>
			</div>

			<div class="personal-tabs__content">
				<button data-fancybox href="#form-sms-info" class="entry__btn entry-page__btn">Обновить данные профиля</button>
			</div>
		</div>
	</div>
</section>