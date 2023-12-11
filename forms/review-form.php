<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die(); ?>

<form class="ajax-form" id="form-review" data-param-id="12">
    <input type="hidden" name="AJAX_CALL" value="Y">
    <input type="hidden" name="WEB_FORM_ID" value="12">
    <input type="hidden" name="id" value="12">
    <input type="hidden" name="RESULT_ID" value="476">
    <input type="hidden" name="formresult" value="addok">
    <!-- RESULT_ID=476
    formresult=addok -->

    <div class="title">Оставьте отзыв</div>

    <div class="rating"></div>

    <div class="fields">
        <label>
            Сообщение
            <textarea name="form_textarea_54" id="" cols="30" rows="10"></textarea>
        </label>

        <label>
            Ваша фотография
            <div class="photo">
                <input type="file" name="form_file_53">
                <span>Прикрепите файл</span>
            </div>
        </label>

        <label>
            Файл
            <div class="file">
                <input type="file" name="form_file_52">
                <span>Прикрепите файл</span>
            </div>
        </label>

        <label>
            Ваше имя
            <input type="text" name="form_text_48">
        </label>

        <label>
            Должность
            <input type="text" name="form_text_51">
        </label>

        <label>
            E-mail
            <input type="text" name="form_email_50">
        </label>

        <label>
            Телефон
            <input type="text" class="inputmask" placeholder=""
                name="form_text_49">
        </label>

    </div>
    <button class="sms__btn button">Отправить</button>
</form>