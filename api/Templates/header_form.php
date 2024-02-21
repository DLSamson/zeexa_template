<?php

use Carbon\Carbon;
use Carbon\CarbonPeriod;

$api = getApi();
$offices = $api->getOffices();


?>
<div class="header-block">
    <form id="header-form" class="header-form" data-ajaxform data-command="form.lead">

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