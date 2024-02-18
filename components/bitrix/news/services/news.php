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

use Carbon\CarbonPeriod;
use Carbon\Carbon;
use function getApi;

$api = getApi();
$services = $api->getPricesByCategories();
$cars = $api->getUserCars();

$this->setFrameMode(true);
?>

<section class="stock-page">
    <div class="container">
        <div class="section">
            <h2 class="section-title">Услуги и цены</h2>

            <div class="filter-inline">
                <div class="services-wrapper" data-services-steps>
                    <div class="service-step-item">
                        <button type="button" class="btn-main active" disabled data-services-step="1">
                            <span>Выберите услугу</span>
                        </button>
                    </div>
                    <div class="service-step-item">
                        <button type="button" class="btn-main " disabled data-services-step="2">
                            <span>Запишитесь на СТО</span>
                        </button>
                    </div>
                </div>
            </div>

            <div data-services-screens>
                <div class="filter-content" data-services-screen="1" data-type="services">
                    <div class="filter-title">
                        Техцентр «НИВЮС» оказывает услуги по ремонту и обслуживанию элитных автомобилей знаменитой
                        немецкой марки BMW. Эти машины являются эталоном хорошего вкуса и достатка, но также они
                        славятся и своей чувствительностью к некачественным ремонтным работам и кустарному оборудованию.
                    </div>
                    <div class="filter-title search">
                        <span>Выберите необходимое обслуживание или воспользуйтесь поиском</span>
                        <span class="search">
                            <input name="search" placeholder="Напишите необходимую работу">
                        </span>
                    </div>

                    <form class="popular-marks" data-services data-spoilers>
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
                                            <div class="stock-item__item" data-service-item>
                                                <label>
                                                    <input type="checkbox" name="service" value="<?= $price->name; ?>" data-id="<?= $price->id; ?>">
                                                    <div>
                                                        <?= $price->name; ?>
                                                    </div>
                                                </label>
                                                <div class="stock-item__price">
                                                    <div>
                                                        <?= $price->price; ?> ₽
                                                    </div>
                                                    <div class="stock-item__item-select-btn">Выбрать</div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </form>

                </div>

                <div class="filter-content" disabled data-services-screen="2" data-type="form">
                    <div class="filter-title">
                        Для записи на СТО заполните анкету
                    </div>

                    <div class="filter-title">
                        Заполните данные об автомобиле
                    </div>
                    <div class="services-forms-container">
                        <div class="services-forms-input-33">
                            <select placeholder="Выберите машину" name="carId" name="time">
                                <option value="" selected disabled hidden>Выберите машину </option>
                                <?php if(!$cars): ?>
                                    <option value="" disabled>Машины отсутствуют</option>
                                <?php endif; ?>
                                <?php foreach ($cars as $car): ?>
                                    <option value="<?= $car->id; ?>">
                                        <?= $car->carSerial->carModel->brand->name; ?> /
                                        <?= $car->carSerial->carModel->name; ?> /
                                        <?= $car->carSerial->name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="services-forms-input-25">
                            <a href="#<?= getApi()->isAuthenticated() ? 'form-add-car' : 'form-sms'?>" data-fancybox >Или добавьте новую</a>
                        </div>
                    </div>

                    <div class="filter-title">
                        Выберите время и место записи
                    </div>
                    <div class="services-forms-container">

                        <div class="services-forms-input-25">
                            <select placeholder="Выберите адрес" name="officeId">
                                <option value="" selected disabled hidden>Выберите адрес</option>
                                <?php foreach (getApi()->getOffices() as $address): ?>
                                    <option value="<?= $address->id; ?>">
                                        <?= $address->address; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="services-forms-input-25">
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
                        </div>

                        <div class="services-forms-input-25">
                            <select placeholder="Выберите время" name="time">
                                <option value="" selected disabled hidden>Выберите время </option>
                                <?php for ($i = 9; $i <= 18; $i++) { ?>
                                    <option value="<?= $i ?>:00">
                                        <?= $i ?>:00
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="services-forms-input-33">
                            <textarea name="comment" id="" cols="30" rows="2" placeholder="Комментарий"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="back-line">
                <a href="#" class="btn-text" data-services-prev>
                    <i>
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/icon/angle-left.svg" class="img-fluid" alt="">
                    </i>
                    <span>Назад</span>
                </a>
            </div>

            <div class="next-line">
                <a href="#" class="btn-red" data-services-next>
                    <span>Продолжить</span>
                </a>
            </div>
        </div>
    </div>
</section>