<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die(); ?>
<form class="ajax-form" id="form-lead" data-command="form.lead">
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