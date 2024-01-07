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
                    <div class="popular-marks" >
                        Услуги
                    </div>
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