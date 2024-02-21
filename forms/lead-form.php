<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die(); ?>
<?php

use Carbon\Carbon;
use Carbon\CarbonPeriod;

$api = getApi();
$offices = $api->getOffices();


?>

<form class="ajax-form" id="form-lead1" data-command="form.lead">
    <div class="fields">
        <label>
            <span>Ваше имя <span class="star">*</span></span>
            <input type="text" name="name">
        </label>

        <label>
            <span>Марка автомобиля <span class="star">*</span></span>
            <input type="text" class="" placeholder="" name="car-model">
        </label>

        <label>
            <span>Желаемая дата и время <span class="star">*</span></span>
            <input type="text" class="" placeholder="" name="date">
        </label>

        <label>
            <span>Укажите номер телефона <span class="star">*</span></span>
            <input type="text" class="inputmask" placeholder="" name="phone">
        </label>

    </div>
    <button class="sms__btn button">Отправить</button>
</form>

<form class="ajax-form" id="form-lead" data-command="form.lead">
    <div class="title">Запись на СТО</div>

    <div class="fields">
        <label>
            <span>Выберите адрес</span>
            <select name="address" id="">
                <?php foreach ($api->getOffices() as $office) : ?>
                    <option value="<?= $office->id; ?>"><?= $office->address; ?></option>
                <?php endforeach; ?>
            </select>
        </label>

        <label>
            <span>Выберите дату</span>
            <select placeholder="Выберите дату" name="date">
                <option value="" selected disabled hidden>Укажите дату</option>
                <?php
                Carbon::setLocale('ru');
                $translate = function (string $day) {
                    switch ($day) {
                        case 'Monday':
                            return 'Понедельник';
                        case 'Tuesday':
                            return 'Вторник';
                        case 'Wednesday':
                            return 'Среда';
                        case 'Thursday':
                            return 'Четверг';
                        case 'Friday':
                            return 'Пятница';
                        default:
                            return $day;
                    }
                };
                $dates = CarbonPeriod::between(Carbon::now(), Carbon::now()
                    ->addMonth(1))
                    ->filter('isWeekday')
                    ->map(fn (Carbon $date) => [
                        'day' => $translate($date->format('l')),
                        'date' => $date->format('d.m'),
                        'value' => $date->startOfDay()->format('c')
                    ]);

                foreach ($dates as $date) : ?>
                    <option value="<?= $date['value'] ?>">
                        <?= $date['day'] . ', ' . $date['date'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <label>
            <span>Выберите время</span>
            <select placeholder="Выберите время" name="time">
                <option value="" selected disabled hidden>Выберите время </option>
                <?php for ($i = 9; $i <= 18; $i++) { ?>
                    <option value="<?= $i ?>:00">
                        <?= $i ?>:00
                    </option>
                <?php } ?>
            </select>
        </label>

        <label>
            <span>Телефон <span class="star">*</span></span>
            <input type="text" class="inputmask" placeholder="" name="phone">
        </label>

    </div>
    
    <button type="submit" class="sms__btn button">Отправить</button>
</form>


<div class="header-block ">
    <form id="form-lead2" class="ajax-form header-form" data-ajaxform data-command="form.lead">

        <div class="header-form__inputs">
            <label>
                <span>
                    Выберие адрес
                </span>
                <div data-dropdown="">
                    <div data-dropdown-current="address">Адрес</div>
                    <input type="hidden" value="" name="address">
                    <ul data-dropdown-list style="display: none;">
                        <?php foreach ($offices as $office) : ?>
                            <li><?= $office->address ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </label>

            <label>
                <span>
                    Выберие дату
                </span>
                <div data-dropdown="">
                    <div data-dropdown-current="date">Дата</div>
                    <input type="hidden" value="" name="date">
                    <ul data-dropdown-list style="display: none;">
                        <?php
                            Carbon::setLocale('ru');
                            $translate = function (string $day) {
                                switch ($day) {
                                    case 'Monday':
                                        return 'Понедельник';
                                    case 'Tuesday':
                                        return 'Вторник';
                                    case 'Wednesday':
                                        return 'Среда';
                                    case 'Thursday':
                                        return 'Четверг';
                                    case 'Friday':
                                        return 'Пятница';
                                    default:
                                        return $day;
                                }
                            };
                            $dates = CarbonPeriod::between(Carbon::now(), Carbon::now()
                                ->addMonth(1))
                                ->filter('isWeekday')
                                ->map(fn (Carbon $date) => [
                                    'day' => $translate($date->format('l')),
                                    'date' => $date->format('d.m')
                                ]);
                        ?>
                        <? foreach ($dates as $date) : ?>
                            <li>
                                <?= $date['day'] . ', ' . $date['date'] ?>
                            </li>
                        <? endforeach; ?>
                    </ul>
                </div>
            </label>

            <label>
                <span>
                    Выберие время
                </span>
                <div data-dropdown="">
                    <div data-dropdown-current="time">Время</div>
                    <input type="hidden" value="" name="time">
                    <ul data-dropdown-list style="display: none;">
                        <?php for ($i = 9; $i <= 18; $i++) { ?>
                            <li>
                                <?= $i ?>:00
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </label>
            
        </div>

        <input type="text" name="phone" class="inputmask header-form__input"
            placeholder="Укажите номер телефона">

        <button class="header-form__btn">Записаться</button>
    </form>

    <button class="btn btn--long btn--long-mobile">Записаться</button>
</div>