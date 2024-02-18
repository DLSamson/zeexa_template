<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Carbon\CarbonPeriod;
use Carbon\Carbon;


$api = getApi();
$cars = $api->getUserCars();
$services = $api->getPricesByCategories();

?>

<form class="ajax-form" id="form-add-maintance-car">
    <div class="title">Запись на СТО</div>
    <p>Выберите автомобиль, который хотите записать</p>

    <div class="fields">
        <?php foreach ($cars as $key => $car) : ?>
            <label>
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
        <?php endforeach; ?>

    </div>
    <button type="submit" class="sms__btn button">Отправить</button>
</form>

<form class="ajax-form" id="form-add-maintance-services">
    <div class="title">Запись на СТО</div>
    <p>Выберите услуги, которыми хотите воспользоваться</p>

    <div class="fields stock-items" data-spoilers>
        <label for="">
            <input type="text" placeholder="Поиск" name="search">
        </label>

        <?php foreach ($services as $category => $prices) : ?>

            <div class="stock-item" data-spoiler>
                <div class="stock-item__header" data-spoiler-control>
                    <div class="stock-item__content">
                        <div class="stock-item__title">
                            <?= $category ?>
                        </div>
                    </div>

                    <div class="stock-item__arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M3 6L8 11L13 6" stroke-width="2.46154" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </svg>
                    </div>
                </div>

                <div class="stock-item__main" data-spoiler-content>
                    <div class="stock-item__wrap" data-service-items>
                        <?php foreach ($prices as $price) : ?>
                            <div class="stock-item__item" data-service-item="<?= $price->name; ?>">
                                <label>
                                    <input type="checkbox" name="service" value="<?= $price->id; ?>" data-name="<?= $price->name; ?>">
                                    <div>
                                        <?= $price->name; ?>
                                    </div>
                                </label>
                                <div class="stock-item__price">
                                    <div>
                                        <?= trim(str_ireplace('от', '', $price->price)); ?>&nbsp;₽
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
    <button type="submit" class="sms__btn button">Отправить</button>
</form>

<form class="ajax-form" id="form-add-maintance-offices">
    <div class="title">Запись на СТО</div>
    <p>Выберите услуги, которыми хотите </p>

    <div class="fields">
        <label>
            <span>Выберите офис</span>
            <select name="officeId" id="">
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
            <span>Комментарий</span>
            <textarea name="comment" cols="30" rows="5"></textarea>
        </label>

    </div>
    <button type="submit" class="sms__btn button">Отправить</button>
</form>


<form class="ajax-form" id="form-maintance-canceled">
    <div class="title">Запись отменена</div>
    <p>Наш менеджер скоро перезвонит Вам</p>
    <button class="sms__btn button">Закрыть</button>
</form>