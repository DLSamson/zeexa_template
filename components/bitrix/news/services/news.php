<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<section class="stock-page">
    <div class="container">
        <div class="section">
            <h2 class="section-title">Услуги и цены</h2>

            <div class="filter-inline">
                <div class="services-wrapper" data-services-steps>
                    <div class="service-step-item">
                        <button type="button" class="btn-main active" data-services-step="1">
                            <span>Укажите марку машины</span>
                        </button>
                    </div>
                    <div class="service-step-item">
                        <button type="button" class="btn-main" disabled data-services-step="2">
                            <span>Укажите модель</span>
                        </button>
                    </div>
                    <div class="service-step-item">
                        <button type="button" class="btn-main" disabled data-services-step="3">
                            <span>Укажите поколение</span>
                        </button>
                    </div>
                    <div class="service-step-item">
                        <button type="button" class="btn-main" disabled data-services-step="4">
                            <span>Выберите услугу</span>
                        </button>
                    </div>
                    <div class="service-step-item">
                        <button type="button" class="btn-main " disabled data-services-step="5">
                            <span>Запишитесь на СТО</span>
                        </button>
                    </div>
                </div>
            </div>

            <div data-services-screens>
                
                <div class="filter-content" data-services-screen="1" data-type="mark">
                    <div class="filter-title">Укажите марку вашего автомобиля</div>
                    <div class="popular-marks" data-marks-popular>
                        
                    </div>
                    <div class="filter-marks" data-marks>
                        
                    </div>
                </div> 

                <div class="filter-content" disabled data-services-screen="2" data-type="model">
                    <div class="filter-title">Укажите модель вашего автомобиля </div>
                    <div class="popular-marks" data-models-popular>
                        
                    </div>
                    <div class="filter-marks" data-models>
                        
                    </div>
                </div>

                <div class="filter-content" disabled data-services-screen="3" data-type="generation">
                    <div class="filter-title">Укажите поколение вашего автомобиля</div>
                    <div class="popular-marks" data-generations-popular>
                        
                    </div>
                    <div class="filter-marks" data-generations>
                        
                    </div>
                </div>
                <div class="filter-content" disabled data-services-screen="4" data-type="services">
                    <div class="filter-title">Выберите необходимое обслуживание или воспользуйтесь поиском</div>

                    <? $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "",
                        array(
                            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                            "NEWS_COUNT" => $arParams["NEWS_COUNT"],
                            "SORT_BY1" => $arParams["SORT_BY1"],
                            "SORT_ORDER1" => $arParams["SORT_ORDER1"],
                            "SORT_BY2" => $arParams["SORT_BY2"],
                            "SORT_ORDER2" => $arParams["SORT_ORDER2"],
                            "FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
                            "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                            "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["detail"],
                            "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
                            "IBLOCK_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["news"],
                            "DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
                            "SET_TITLE" => $arParams["SET_TITLE"],
                            "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                            "MESSAGE_404" => $arParams["MESSAGE_404"],
                            "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                            "SHOW_404" => $arParams["SHOW_404"],
                            "FILE_404" => $arParams["FILE_404"],
                            "INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
                            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                            "CACHE_TIME" => $arParams["CACHE_TIME"],
                            "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                            "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                            "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                            "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                            "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                            "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                            "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                            "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                            "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                            "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                            "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                            "DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
                            "DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
                            "PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
                            "ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
                            "USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
                            "GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
                            "FILTER_NAME" => $arParams["FILTER_NAME"],
                            "HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
                            "CHECK_DATES" => $arParams["CHECK_DATES"],
                        ),
                        $component
                    ); ?>
                </div>
                <div class="filter-content" disabled data-services-screen="5" data-type="form">
                    <div class="filter-title">Для записи на СТО заполните анкету</div>
                    <div class="popular-marks">
                        Форма
                    </div>
                </div>
            </div>

            <div class="back-line">
                <a href="#" class="btn-text" data-services-prev>
                    <i>
                        <img src="images/icon/angle-left.svg" class="img-fluid" alt="">
                    </i>
                    <span>Назад</span>
                </a>
            </div>

            <div class="next-line">
                <a href="#" class="btn-red" data-services-next>
                    <span>Продолжить</span>
                </a>
            </div>
        </div>
    </div>
</section>