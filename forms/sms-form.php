<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die(); ?>


<form class="sms__block ajax-form" id="form-sms">
    <a href="#" class="sms__logo">
        <img src="<?= SITE_TEMPLATE_PATH ?>/img/icon/logo.svg" alt="img">
    </a>
    <div class="sms__title">Авторизация</div>
    <input type="text" class="sms__input" placeholder="Введите номер телефона">
    <button class="sms__btn button">Продолжить</button>
</form>