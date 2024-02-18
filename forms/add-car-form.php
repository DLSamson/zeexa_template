<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die(); ?>

<form class="ajax-form" id="form-add-car">
    <div class="title">Добавить машину</div>
    <p>Добавьте машину, она будет отображаться в вашем профиле.</p>

    <div class="fields">
        <span class="loader" style="display:none;"></span>

        <div>
            <span>Марка<span class="star">*</span></span>
            <div data-dropdown="brands">
                <div data-dropdown-current>
                    Выберите модель
                </div>
                <input type="text" placeholder="Поиск..." data-dropdown-search style="display: none;">
                <ul data-dropdown-list style="display: none;"></ul>
            </div>
        </div>

        <label style="display:none;">
            <span>Модель <span class="star">*</span></span>

            <div data-dropdown="models">
                <div data-dropdown-current>
                    Выберите модель
                </div>
                <input type="text" placeholder="Поиск..." data-dropdown-search style="display: none;">
                <ul data-dropdown-list style="display: none;"></ul>
            </div>
        </label>

        <label style="display:none;">
            <span>Серия <span class="star">*</span></span>
            <div data-dropdown="serials">
                <div data-dropdown-current>
                    Выберите модель
                </div>
                <input type="text" placeholder="Поиск..." data-dropdown-search style="display: none;">
                <ul data-dropdown-list style="display: none;"></ul>
            </div>
        </label>

        <label>
            <span>Гос. Номер <span class="star">*</span></span>
            <input type="text" name="gos-number">
        </label>

        

    </div>
    <button class="sms__btn button">Отправить</button>
</form>