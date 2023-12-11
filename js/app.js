"use strict"

function initSliders() {

    if (document.querySelector('[data-filter]')) {
        new Swiper('[data-filter]', {

            observer: true,
            observeParents: true,
            slidesPerView: 'auto',
            spaceBetween: 25,
            autoHeight: true,
            speed: 800,
        });
    }

    if (document.querySelector('[data-options]')) {
        new Swiper('[data-options]', {

            observer: true,
            observeParents: true,
            slidesPerView: 3,
            spaceBetween: 18,
            speed: 800,
            pagination: {
                el: '[data-options-pagination]',
                clickable: true,
            },
            navigation: {
                nextEl: '[data-options-next]',
                prevEl: '[data-options-prev]',
            },
            breakpoints: {
                768: {
                    slidesPerView: 4,
                },
                1200: {
                    slidesPerView: 6,
                },
            },
        });
    }


    if (document.querySelector('[data-items]')) {
        new Swiper('[data-items]', {
            observer: true,
            observeParents: true,
            slidesPerView: 'auto',
            spaceBetween: 15,
            pagination: {
                el: '[data-items-pagination]',
                clickable: true,
            },
            breakpoints: {
                768: {
                    spaceBetween: 20,
                },
            },
        });
    }
}

function initLazyLoad() {
    const images = document.querySelectorAll('.lazyload');
    console.log(images);
    Array.from(images).forEach(image => {
        const actualSrc = image.dataset['src'] ?? image.src;
        image.src = actualSrc;
    });
}

// Filter
document.addEventListener('click', (event) => {
    if (event.target.closest('[data-filter-item]')) {
        event.target.closest('[data-filter]').querySelectorAll('[data-filter-item]').forEach(elem => {
            elem.classList.remove('active');
        });
        event.target.closest('[data-filter-item]').classList.add('active')
    }
})

// Spoilers
document.addEventListener('click', (event) => {
    if (event.target.closest('[data-spoiler-control]')) {
        const spoilerItem = event.target.closest('[data-spoiler]');
        const spoilerGroup = event.target.closest('[data-spoilers]');
        const spoilerContent = spoilerItem.querySelector('[data-spoiler-content]');
        const spoilersArray = spoilerGroup.querySelectorAll('[data-spoiler]');
        const isOneSpoiler = spoilerGroup.hasAttribute('data-one-spoilers');
        const spoilerIsOpen = spoilerItem.classList.contains('open');

        if (isOneSpoiler) {
            if (!spoilerIsOpen) {
                spoilersArray.forEach(elem => {

                    if (elem.classList.contains('open')) {
                        slidetoggle.hide(
                            elem.querySelector('[data-spoiler-content]'),
                            {
                                miliseconds: 200,
                            }
                        )
                        elem.classList.remove('open')
                    }
                });

                slidetoggle.show(
                    spoilerContent,
                    {
                        miliseconds: 200,
                    }
                )
                spoilerItem.classList.add('open')
            }
            else {

            }
        }
        else {
            slidetoggle.toggle(
                spoilerContent,
                {
                    miliseconds: 200,
                }
            )
            spoilerItem.classList.toggle('open')
        }
    }
})

document.addEventListener('click', (event) => {
    if (event.target.closest('.price-checkout__button')) {
        let checkbox = event.target.closest('.spoiler__list__item').querySelector('input')

        if (checkbox.checked) {
            checkbox.checked = null
        }
        else {
            checkbox.checked = 'checked'
        }
    }
})

window.addEventListener("load", function (e) {

    initSliders();
    initLazyLoad();

    const myModal = new HystModal({
        linkAttributeName: 'data-hystmodal',
    });

});


const DEBUG = true;
const log = (message, data = undefined) => {
    if (!DEBUG) return;
    data
        ? console.log(message, data)
        : console.log(message);
};

const logger = (prefix) => (message, data = undefined) => log(`${prefix}: ${message}`, data);

const fetchAPI = (url, config = {}) => {
    const log = logger('fetchAPI');
    const defaultConfig = {
        method: 'POST',
        success: (response) => log('Success', response),
        error: (error) => log('Error', error),
    };
    $.ajax(url, Object.assign(config, defaultConfig));
};

const initModules = (initializers) => {
    $(() => {
        initializers.forEach(initializer => {
            try { initializer(); }
            catch (e) { log(`Error occured while executing: ${initializer.name}`, e) }
        });
    });
};

const initDebug = () => {
    const log = logger('debug');
    log('START');

    log('JQuery plugins', {
        $,
        jquery: jQuery,
        fancybox: $.fancybox,
        starRating: $.starRating,
    })

    log('END');
}

const initFancyboxSettings = () => {
    $.fancybox.defaults.touch = false;
}

const initPhoneMasks = () => {
    const inputs = $('input.inputmask');
    const log = logger('initPhoneMasks');
    if (inputs.length == 0) {
        log('Phone input not found');
        return;
    }

    if (navigator.userAgent.match(/Android/i)) $(element).attr("type", "text");
    inputs.inputmask({ url: './phone-codes.json', alias: 'phone' });
}

const initRatingInput = () => {
    const log = logger('initRatingInput');
    const ratingInput = $('.rating');
    if (ratingInput.length == 0) {
        log('Rating input not found');
        return;
    };
    log('START', { ratingInput });

    ratingInput.starRating({
        starIconEmpty: 'far fa-star',
        starIconFull: 'fas fa-star',
        starColorEmpty: 'lightgray',
        starColorFull: '#FFC107',
        starsSize: 1.5, // em
        stars: 5,
        inputName: 'form_text_47',
    });

    ratingInput.find('strong, h4').remove();
    ratingInput.css('align-items', 'start');

    log('END');
}

const initAjaxForms = () => {
    const log = logger('initAjaxForms');
    const ajaxForms = $('.ajax-form');
    if (ajaxForms.length == 0) {
        log('Ajax form not found');
        return;
    };
    log('START');

    const onAjaxFormSubmit = (event) => {
        event.preventDefault();
        const form = $(event.delegateTarget);
        const formData = form.serialize();
        const paramId = form.data('param-id');

        log('Form submitted', {
            form, formData
        });

        fetchAPI('/ajax/form.php', {
            method: 'POST',
            data: form.serializeArray().push(
                { name: 'param_id', value: paramId }
            ),
        });
    }

    ajaxForms.on('submit', onAjaxFormSubmit);

    log('END');
}

const initFileInputUpload = () => {
    const input = $('input[type="file"]');
    const log = logger('initFileInputUpload');
    if (input.length == 0) {
        log('File input not found');
        return;
    };
    log('START');

    const onFileInputChange = (event) => {
        const input = $(event.delegateTarget);
        const parent = input.parent();
        const span = parent.find('span');
        const fileName = event.delegateTarget.files[0].name;

        log('File selected', {
            input, parent, fileName
        })

        span.text(fileName);
    }

    input.on('change', onFileInputChange);

    log('END');
}

initModules([
    initDebug,
    initPhoneMasks,
    initFancyboxSettings,
    initRatingInput,
    initFileInputUpload,
    initAjaxForms,
]);