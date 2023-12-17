<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die(); ?>

<form class="ajax-form" id="form-call" data-command="form.call">
    <div class="title">Заказать звонок</div>
    <p>Представьтесь, мы вам перезвоним.</p>

    <div class="fields">
        <label>
            <span>Ваше имя <span class="star">*</span></span>
            <input type="text" name="name">
        </label>

        <label>
            <span>Телефон <span class="star">*</span></span>
            <input type="text" class="inputmask" placeholder="" name="phone">
        </label>

        <label class="checkbox">
            <input type="checkbox" name="agreement" checked value="on" id="">
            <div class="switch-btn switch-on"></div>

            <span class="text-grey">
                Я согласен на
                <a href="" data-fancybox data-filter="" data-type="ajax" data-src="/include/licenses_detail.php">обработку персональных данных</a>
            </span>
        </label>

    </div>
    <button class="sms__btn button">Отправить</button>
</form>