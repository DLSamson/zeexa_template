<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die(); ?>

<form class="ajax-form" id="form-vacancy" data-command="form.vacancy">
    <div class="title">Отправить резюме</div>

    <div class="fields">
        <label>
            <span>Ваше имя <span class="star">*</span></span>
            <input type="text" name="name">
        </label>

        <label>
            <span>Телефон <span class="star">*</span></span>
            <input type="text" class="inputmask" placeholder="" name="phone">
        </label>

        <label>
            E-mail
            <input type="text" name="email">
        </label>

        <label>
            <span>Желаемая должность <span class="star">*</span></span>
            <input type="text" name="post">
        </label>

        <label>
            Дополнительная информация
            <textarea name="message" id="" cols="30" rows="10"></textarea>
        </label>

        <label>
            Файл с резюме
            <div class="file">
                <input type="file" name="file">
                <span>Прикрепите файл</span>
            </div>
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