<?php

use Carbon\Carbon;
use App\Services\ApiService;

$car = $maintance->car;
$currentIcon = $maintance->status === ApiService::UNDER_MAINTANCE
    ? 'big_working.png'
    : 'big_check.png';
$currentMessage = $maintance->status === ApiService::UNDER_MAINTANCE
    ? 'Обслуживание'
    : 'Вы записаны';

$dayOfWeek = [
    'Monday' => 'Понедельник',
    'Tuesday' => 'Вторник',
    'Wednesday' => 'Среда',
    'Thursday' => 'Четверг',
    'Friday' => 'Пятница',
    'Saturday' => 'Суббота',
    'Sunday' => 'Воскресенье'
];

$month = [
    'January' => 'января',
    'February' => 'февраля',
    'March' => 'марта',
    'April' => 'апреля',
    'May' => 'мая',
    'June' => 'июня',
    'July' => 'июля',
    'August' => 'августа',
    'September' => 'сентября',
    'October' => 'октября',
    'November' => 'ноября',
    'December' => 'декабря'
];

$readableDay = $dayOfWeek[Carbon::parse($maintance->appointmentTime)->format('l')];
$readableMonth = $month[Carbon::parse($maintance->appointmentTime)->format('F')];

$readAbleAppointmentTime = Carbon::parse($maintance->appointmentTime)
    ->format("$readableDay, j $readableMonth на H:i");

?>

<form class="ajax-form maintance-form" id="maintance-<?= $maintance->id; ?>">
    <div class="center fit-content maintance-status-icon">
        <img src="<?= SITE_TEMPLATE_PATH ?>/img/icon/<?= $currentIcon ?>" alt="">
    </div>

    <div class="center fit-content maintance-status-message">
        <?= $currentMessage ?>
    </div>

    <div class="center fit-content maintance-status-time">
        <?= $readAbleAppointmentTime ?>
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