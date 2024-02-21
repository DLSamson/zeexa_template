<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();  

use Carbon\Carbon;

$api = getApi();
$user = $api->getUser();

?>

<form class="sms__block" id="form-sms">

    <a href="#" class="sms__logo">
        <img src="<?= SITE_TEMPLATE_PATH ?>/img/icon/logo.svg" alt="img">
    </a>

    <div class="sms__title">Авторизация</div>

    <input type="text" name="phone-code" class="sms__input inputmask" placeholder="Введите номер телефона">

    <button type="submit" class="sms__btn button">Продолжить</button>
</form>



<form class="sms-code__block" id="form-sms-code">
    <a href="#" class="sms-code__logo">
        <img src="<?= SITE_TEMPLATE_PATH ?>/img/icon/logo.svg" alt="img">
    </a>

    <div class="sms-code__title">Авторизация</div>

    <div class="sms-code__box">
        <input type="text" maxlength="1" data-code="0" required name="code" class="sms-code__input" placeholder="">
        <input type="text" maxlength="1" data-code="1" required name="code" class="sms-code__input" placeholder="">
        <input type="text" maxlength="1" data-code="2" required name="code" class="sms-code__input" placeholder="">
        <input type="text" maxlength="1" data-code="3" required name="code" class="sms-code__input" placeholder="">
    </div>

    <div href="" class="sms-code__text" data-counter-text>
        Отправить код повторно <span data-counter></span>
    </div>

    <button type="submit" class="sms-code__btn button">Продолжить</button>
</form>

<form class="ajax-form" id="form-sms-info">
    <div class="title">Стать клиентом НИВЮС</div>
    <p>Укажите Ваши данные, чтобы использовать все функции приложения</p>
    
    <div class="fields">
        <div class="nivus__box">
            <div 
                class="nivus__box-btn button <?= $user->gender == 'M' ? 'nivus__box-btn--disabled' : ''?>" 
                data-gender="M"
            >
                Я-мужчина
            </div>
            <div 
                class="nivus__box-btn button <?= $user->gender == 'M' ? '' : 'nivus__box-btn--disabled'?>"
                data-gender="F"
            >
                Я-женщина
            </div>
        </div>

        <label>
            <span>Имя</span>
            <input type="text" 
                name="name" 
                placeholder="" 
                value="<?= $user->name ?>"
            >
        </label>

        <label>
            <span>Фамилия</span>
            <input type="text" 
                name="surname" 
                placeholder="" 
                value="<?= $user->surname ?>"
            >
        </label>

        <label>
            Отчество
            <input type="text" 
                name="patronymic" 
                placeholder="" 
                value="<?= $user->patronymic ?>"
            >
        </label>

        <label class="checkbox">
            <input type="checkbox" 
                name="nopatronymic" 
                value="on"
                <?= $user->nopatronymic ? 'checked' : ''?>
            >
            <div class="switch-btn"></div>

            <span style="font-size: 2rem;">Нет отчества</span>
        </label>

        <label>
            Дата рождения
            <input 
                type="text" 
                name="birthdate" 
                placeholder="" 
                value="<?= Carbon::parse($user->birthday)->format('d.m.Y'); ?>"
            >
        </label>

    </div>

    <button type="submit" class="expect__btn button">Продолжить</button>
</form>