<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die(); ?>
</main>

<footer class="footer">
    <div class="container">
        <div class="footer__inner">
            <div class="footer-top">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "footer",
                    array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "left",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "1",
                        "MENU_CACHE_GET_VARS" => array(
                        ),
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "top",
                        "USE_EXT" => "N",
                        "COMPONENT_TEMPLATE" => "footer"
                    ),
                    false
                ); ?>

                <div class="footer-top__inner">
                    <div class="footer-top__phone">
                        <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/footer/footer_contacts.php'); ?>
                    </div>

                    <div class="footer-top__email">
                        <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/footer/footer_emails.php'); ?>
                    </div>
                </div>
            </div>

            <div class="footer-center">
                <div class="footer-center__img">
                    <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/footer/footer_apps.php'); ?>
                </div>

                <div class="footer-center__address">
                    <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/footer/footer_places.php'); ?>
                </div>
            </div>

            <div class="footer__bottom">
                <div class="footer__bottom-polity">
                    <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/footer/footer_confidentials.php'); ?>
                </div>
                <div class="footer__bottom-text">
                    <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/footer/footer_credentials.php'); ?>
                </div>
                <div class="footer__bottom-social">
                    <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/footer/footer_socials.php'); ?>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/including_areas/footer/footer_maps.php'); ?>

<?php
include 'forms/index.php';
$path = str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'] . '/' . SITE_DIR . 'include/');
$file = $path . 'invis-counter.php';
@include_once $file;

\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/jquery-3.7.1.min.js', true);
\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/jquery.star-rating.js', true);
\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/jquery.fancybox.min.js', true);

\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/jquery.inputmask-5.0.5.min.js', true);
\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/jquery.inputmask.binding-5.0.5.min.js', true);
\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/inputmask.phone.extensions.js', true);
\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/phone.js', true);
\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/phone-ru.js', true);


\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/slick.min.js', true);
\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/main.min.js');
\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/dem.js');
\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/swiper-bundle.min.js', true);
\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/slidetoggle.js');
\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/hystmodal.min.js', true);
\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/app.js');

$APPLICATION->ShowBodyScripts();
?>

</body>

</html>