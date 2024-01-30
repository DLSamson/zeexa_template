<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die(); ?>

<form class="sms__block" id="form-sms">

    <a href="#" class="sms__logo">
        <img src="<?= SITE_TEMPLATE_PATH ?>/img/icon/logo.svg" alt="img">
    </a>

    <div class="sms__title">Авторизация</div>

    <input type="text" name="phone" class="sms__input inputmask" placeholder="Введите номер телефона">

    <button type="submit" class="sms__btn button">Продолжить</button>
</form>



<form class="sms-code__block" id="form-sms-code">
    <a href="#" class="sms-code__logo">
        <img src="<?= SITE_TEMPLATE_PATH ?>/img/icon/logo.svg" alt="img">
    </a>

    <div class="sms-code__title">Авторизация</div>

    <div class="sms-code__box">
        <input type="text" name="code" class="sms-code__input" placeholder="">
        <input type="text" name="code" class="sms-code__input" placeholder="">
        <input type="text" name="code" class="sms-code__input" placeholder="">
        <input type="text" name="code" class="sms-code__input" placeholder="">
    </div>

    <a href="" class="sms-code__text" data-counter-text>
        Отправить код повторно <span data-counter></span>
    </a>

    <button type="submit" class="sms-code__btn button">Продолжить</button>
</form>