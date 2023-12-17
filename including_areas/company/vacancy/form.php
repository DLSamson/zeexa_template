<form class="vacancies-block">
    <div class="vacancies-box">
        <div class="vacancies-box__item">
            Контактное лицо
            <span class="vacancies-box__item-input">
                <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/company/vacancy/form/name.php'); ?>
            </span>
            <!-- <input class="vacancies-box__item-name" type="text" placeholder="Мельникова Анастасия"> -->
        </div>
        <div class="vacancies-box__item">
            E-mail
            <span class="vacancies-box__item-input">
                <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/company/vacancy/form/email.php'); ?>
            </span>
            <!-- <input class="vacancies-box__item-input" type="text" placeholder="hr@nivus.ru"> -->
        </div>
        <div class="vacancies-box__item">
            Телефон
            <span class="vacancies-box__item-input">
                <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/company/vacancy/form/phone.php'); ?>
            </span>
            <!-- <input class="vacancies-box__item-input" type="text" placeholder="+7 (495) 125-29-91"> -->
        </div>
    </div>
    <p class="vacancies-block__text">
        <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/company/vacancy/form/text.php'); ?>
    </p>
    <a class="vacancies-block__btn button" href="#form-vacancy" data-fancybox>Отправить резюме</a>
</form>