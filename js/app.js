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

        new Swiper('[data-items-main]', {
            observer: true,
            observeParents: true,
            slidesPerView: 'auto',
            pagination: {
                el: '[data-items-pagination]',
                clickable: true,
            },
        });
    }
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
    const ajaxConfig = Object.assign({
        method: 'POST',
        success(response) { log('Success', response) },
        error(error) { log('Error', error) },
        complete() { log('Complete') },
    }, config);
    log('Request config', { url, ajaxConfig });
    $.ajax(url, ajaxConfig);
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
    const readOnlyRating = $('.rating.readonly');
    if (ratingInput.length == 0 || readOnlyRating.length == 0) {
        log('Rating input not found');
        return;
    };
    log('START', { ratingInput, readOnlyRating });

    ratingInput.rating({
        stars: 5,
        value: 1,
    });

    readOnlyRating.rating({
        stars: 5,
        value: 0,
        readonly: true,
    });

    log('END');
}

const initCheckboxInputs = () => {
    const log = logger('initCheckboxInputs');
    const labels = $('label.checkbox');
    if (labels.length == 0) {
        log('Checkbox input not found');
        return;
    };
    log('START');

    const onLabelClick = (event) => {
        const label = $(event.delegateTarget);
        const input = $('input[type="checkbox"]', label);
        const div = $('div.switch-btn', label);

        const isChecked = !input.prop('checked');
        input.prop('checked', isChecked);

        log('Checkbox clicked', {
            event, label, input, isChecked, div
        });

        isChecked
            ? div.addClass('switch-on')
            : div.removeClass('switch-on');
    }
    $(labels).on('click', onLabelClick);

    log('END');
}

const initLazyLoad = () => {
    const images = document.querySelectorAll('.lazyload');
    console.log(images);
    Array.from(images).forEach(image => {
        const actualSrc = image.dataset['src'] ?? image.src;
        image.src = actualSrc;
    });
}

const initAjaxForms = () => {
    const log = logger('initAjaxForms');
    const ajaxForms = $('.ajax-form, [data-ajaxform]');
    if (ajaxForms.length == 0) {
        log('Ajax form not found');
        return;
    };
    log('START');

    const onAjaxFormSubmit = (event) => {
        event.preventDefault();
        const form = $(event.delegateTarget);
        const formCommand = form.data('command');
        const formData = new FormData(form[0]);

        log('Form submitted', {
            form, formData
        });

        const onFetchApiResponseSuccess = (response) => {
            log('onFetchApiResponseSuccess', response);
            form[0].reset();
            const detached = form.children().detach();

            $('<span>')
                .delay(3000)
                .addClass('message')
                .addClass('title')
                .text('Ваша заявка успешно отправлена!')
                .css('color', '#C63235')
                .css('font-size', '2rem')
                .css('font-weight', 'bold')
                .appendTo(form)
                .delay(3000)
                .fadeOut(500, () => {
                    form.children('span.message').first().remove();
                    form.append(detached);
                    form.trigger("reset");

                    const inputs = $('input, textarea, select, button', form);
                    log('Complete success message', { inputs });
                    inputs.removeAttr('disabled');
                    inputs.val('');
                    // Find input with agreement checkbox and set to true
                    const agreementCheckbox = $('input[type="checkbox"][name="agreement"]');
                    agreementCheckbox.prop('checked', true);
                });
        }

        const onFetchApiResponseError = (xhr, status, error) => {
            const statusCode = xhr.statusCode().status;
            log('onFetchApiResponseError', { xhr, status, error, statusCode });

            if (statusCode == 400) {
                const response = JSON.parse(xhr.responseText);
                log('Error response', { response, errors: response.data.errors });
                response.data.errors.forEach(error => {
                    form
                        .find(`[name="${error.field}"]`)
                        .addClass('error')
                        .parents('label')
                        .addClass('error');
                });
            }
        }

        fetchAPI(`/local/templates/zeexa/api/index.php?command=${formCommand}`, {
            method: 'POST',
            data: formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            success: onFetchApiResponseSuccess,
            error: onFetchApiResponseError,
            beforeSend: () => {
                const inputs = $('input, textarea, select, button', form);
                log('Before request', { inputs });
                inputs
                    .attr('disabled', true)
                    .removeClass('error')
                    .parents('label')
                    .removeClass('error');
            },
            complete: () => {
                const inputs = $('input, textarea, select, button', form);
                log('Complete Request', { inputs });
                inputs.removeAttr('disabled');
            }
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
        /** @type {String} */
        const fileName = event.delegateTarget.files[0].name;

        log('File selected', {
            input, parent, fileName
        })

        span.text(fileName.length > 20 ? fileName.slice(0, 20) + '...' : fileName);
    }

    input.on('change', onFileInputChange);

    log('END');
}


const fetchNivusApi = (path, settings) => {
    const log = logger('fetchNivusApi');
    const url = `/local/templates/zeexa/api/index.php?command=api&uri=${path}`;

    log('Request config', { url, settings });
    return $.ajax(url, Object.assign({
        method: 'GET',
        dataType: 'json',
        contentType: 'application/json',
        success(response) { log('Success', response) },
        error(error) { log('Error', error) },
        complete() { log('Complete') },
    }, settings));
}

const initServices = () => {
    const log = logger('initServices');
    const container = $('.stock-page');
    if (container.length == 0) {
        log('Container not found');
        return;
    }
    log('START');

    const state = {
        currentStep: 4,
        currentMaxStep: 4,
        maxScreens: null,
        minScreens: 1,
    }
    const inputs = {}

    const stepsContainer = $('[data-services-steps]', container);
    const steps = $('[data-services-step]', stepsContainer);
    const getCurrentStep = () => steps.filter((i, step) => $(step).data('services-step') == state.currentStep)
    state.maxScreens = steps.length;

    const screenContainer = $('[data-services-screens]', container);
    const screens = $('[data-services-screen]', screenContainer);
    const getCurrentScreen = () => screens.filter((i, screen) => $(screen).data('services-screen') == state.currentStep)

    const nextButton = $('[data-services-next]', container);
    const prevButton = $('[data-services-prev]', container);

    const updateScreen = () => {
        screens.attr('disabled', true);
        const currentScreen = getCurrentScreen().removeAttr('disabled');
        screenInitializers[state.currentStep](currentScreen);
        nextButton.find('span').text(state.currentStep == state.maxScreens ? 'Записаться' : 'Продолжить');
    }
    const updateStep = () => {
        steps.toArray().map(step => $(step)
            .removeClass('active')
            .attr('disabled', true)
        )
            .filter(step => $(step).data('services-step') <= state.currentMaxStep)
            .forEach(step => $(step).removeAttr('disabled'));

        getCurrentStep().addClass('active');
    }
    const update = () => {
        log('Current state: ', state);
        updateStep();
        updateScreen();
    }

    const onNextButtonClick = (event) => {
        event?.preventDefault();

        if (state.currentStep == state.maxScreens) {
            nextButton.attr('disabled', true);
            fetchAPI(`/local/templates/zeexa/api/index.php?command=form.services`, {
                data: inputs,
                success(response) {
                    const modal = $('<div>')
                        .addClass('services-modal')
                        .text('Вы успешно записались');

                    $.fancybox.open(modal);
                },
                error() {
                    const modal = $('<div>')
                        .addClass('services-modal')
                        .text('Не все поля заполнены');

                    $.fancybox.open(modal);
                }
            })
        }

        if (state.currentStep < state.maxScreens) {
            state.currentMaxStep += 1;
            state.currentStep += 1;
        }
        log('State', { state, inputs });
        update();
    }
    const onPrevButtonClick = (event) => {
        event?.preventDefault();
        if (state.currentStep > state.minScreens) {
            state.currentStep -= 1;
        }
        log('State', { state, inputs });
        update();
    }
    const onStepClick = (event) => {
        event.preventDefault();
        state.currentStep = $(event.delegateTarget).data('services-step');
        if (state.currentStep < 3) {
            state.currentMaxStep = state.currentStep;
        }
        log('State', { state, inputs });
        update();
    }

    const screenInitializersState = {
        markInitialized: 0,
        markPage: 0,
    }
    const screenInitializers = {
        1: (screen) => {
            if (screenInitializersState.markInitialized == 2) return;
            const popularMarksContainer = $('[data-marks-popular]', screen).empty();
            const popularLoader = $('<div>').addClass('loader').appendTo(popularMarksContainer);
            try { popularMarksContainer.slick('unslick').hide(); } catch (e) { }
            log('popularMark', { popularMarksContainer, popularLoader });

            fetchNivusApi('/api/brands/popular', {
                success(response) {
                    log('Success', response);

                    popularLoader.remove();
                    popularMarksContainer.show().append(response.map(mark =>
                        //<a href="" data-popular-mark="id">{name}</a>
                        $('<a>')
                            .attr('href', '')
                            .attr('data-popular-mark', mark.id)
                            // .text(mark.name)
                            .on('click', function (event) {
                                event?.preventDefault();
                                popularMarksContainer.find('[data-popular-mark]').removeClass('active');
                                allMarksContainer.find('[data-mark]').removeClass('active');
                                $(this).addClass('active');
                                inputs.mark = $(this).data('popular-mark');
                            })
                            .addClass('popular-mark')
                            .append(
                                $('<img>')
                                    .attr('src', `/local/templates/zeexa/img/logos/brands/${mark.name}.png`)
                                    .attr('alt', mark.name)
                                    .addClass('popular-mark-logo')
                            )
                    ));

                    popularMarksContainer.slick({
                        arrows: false,
                        infinite: false,
                        slidesToShow: 6,
                        slidesToScroll: 6,
                        rows: 1,
                        dots: true,
                        responsive: [
                            {
                                breakpoint: 1200,
                                settings: {
                                    slidesToShow: 4,
                                    slidesToScroll: 4
                                }
                            },
                            {
                                breakpoint: 768,
                                settings: {
                                    slidesToShow: 3,
                                    slidesToScroll: 3
                                }
                            },
                            {
                                breakpoint: 450,
                                settings: {
                                    slidesToShow: 2,
                                    slidesToScroll: 2
                                }
                            }
                        ],
                    });

                    screenInitializersState.markInitialized++;
                },
            });

            const allMarksContainer = $('[data-marks]', screen).empty();
            const allMarksLoader = $('<div>').addClass('loader').appendTo(allMarksContainer);
            log('allMarksContainer', { allMarksContainer, allMarksLoader });

            fetchNivusApi('/api/brands', {
                data: {
                    page: screenInitializersState.markPage++,
                    size: (6 * 8) - 1,
                },
                success(response) {
                    log('Success', { response, allMarksLoader });
                    allMarksLoader.remove();
                    allMarksContainer.append(response.map(mark =>
                        $('<a>')
                            .attr('href', '')
                            .attr('data-mark', mark.id)
                            .text(mark.name)
                            .on('click', function (event) {
                                event?.preventDefault();
                                popularMarksContainer.find('[data-popular-mark]').removeClass('active');
                                allMarksContainer.find('[data-mark]').removeClass('active');
                                $(this).addClass('active');
                                inputs.mark = $(this).data('mark');
                            })
                    ));

                    screenInitializersState.markInitialized++;
                }
            });
        },
        2: (screen) => {
            const allModelsContainer = $('[data-models]', screen).empty();
            const allModelsLoader = $('<div>').addClass('loader').appendTo(allModelsContainer);
            log('allModelsContainer', { allModelsContainer, allModelsLoader });

            fetchNivusApi('/api/models', {
                data: { brand: inputs.mark },
                success(response) {
                    log('Success', { response, allModelsLoader });
                    allModelsLoader.remove();
                    allModelsContainer.append(response.map(model =>
                        $('<a>')
                            .attr('href', '')
                            .attr('data-model', model.id)
                            .text(model.name)
                            .on('click', function (event) {
                                event?.preventDefault();
                                allModelsContainer.find('[data-model]').removeClass('active');
                                $(this).addClass('active');
                                inputs.model = $(this).data('model');
                            })
                    ));
                }
            });
        },
        3: (screen) => {
            const allGenerationsContainer = $('[data-generations]', screen).empty();
            const allGenerationsLoader = $('<div>').addClass('loader').appendTo(allGenerationsContainer);
            log('allGenerationsContainer', { allGenerationsContainer, allGenerationsLoader });

            fetchNivusApi('/api/serials', {
                data: { model: inputs.model },
                success(response) {
                    log('Success', { response, allGenerationsLoader });
                    allGenerationsLoader.remove();
                    allGenerationsContainer.append(response.map(generation =>
                        $('<a>')
                            .attr('href', '')
                            .attr('data-generation', generation.name)
                            .text(generation.name)
                            .on('click', function (event) {
                                event?.preventDefault();
                                allGenerationsContainer.find('[data-generation]').removeClass('active');
                                $(this).addClass('active');
                                inputs.generation = $(this).data('generation');
                            })
                    ));
                }
            });
        },
        4: (screen) => {
            if (screenInitializersState.isServicesInited) return;

            const form = $(screen).find('form');
            const serviceGroups = form.children();
            const services = serviceGroups.find('[data-service-item]');
            const searchInput = $('input[name=search]', screen);

            services.each((i, service) => {
                const onInputChange = (event) => {
                    const input = $(event.delegateTarget);
                    const btn = $(service).find('.stock-item__item-select-btn');
                    if (!inputs.services)
                        inputs.services = [];

                    if (input.prop('checked')) {
                        inputs.services.push({
                            id: input.data('id'),
                            text: input.val()
                        });
                        btn.text('Отменить');
                    }
                    else {
                        inputs.services = inputs.services
                            .filter(service =>
                                service.id !== input.data('id'));
                        btn.text('Выбрать');
                    }
                    log('Input change', {
                        services: inputs.services,
                        btn,
                        input,
                        service
                    });
                }

                $('input', service).on('change', onInputChange);

                $('.stock-item__item-select-btn', service).on('click', (event) => {
                    const input = $('input', service);
                    input.click();
                    log('btn clicked', { input, service });
                });
            });

            const onSearchInputChange = (event) => {
                const input = $(event.delegateTarget);
                /** @var {string} searchText */
                const searchText = input.val().toLowerCase();
                log('Search input change', { input, searchText });

                if (searchText === '')
                    serviceGroups.show();

                serviceGroups.each((i, group) => {
                    let found = false;
                    const services = $('[data-service-item]', group);
                    services.each((i, service) => {
                        /** @var {string} text */
                        $(service).hide();
                        const text = $(service).find('input').val();
                        if (text.toLowerCase().includes(searchText)) {
                            found = true;
                            $(service).show();
                        }
                        log('Service text', { text, searchText });
                    });

                    // log('Found', { group, found });
                    found
                        ? $(group).show()
                        : $(group).hide();
                });
            }

            searchInput.on('input', onSearchInputChange);

            screenInitializersState.isServicesInited = true;
        },
        5: (screen) => {
            log('Inputs', { inputs });
            if (!screenInitializersState.isFormInited) {
                const onChange = (event) => {
                    const target = $(event.delegateTarget);
                    log('Input change', { target, event, inputs });
                    inputs[target.attr('name')] = $(event.delegateTarget).val();
                };
                $('[name=phone]', screen).on('keyup', onChange);
                $('[name=win-number]', screen).on('keyup', onChange);
                $('[name=gos-number]', screen).on('keyup', onChange);
                $('[name=address]', screen).on('change', onChange);
                $('[name=date]', screen).on('change', onChange);
                $('[name=time]', screen).on('change', onChange);

                fetchNivusApi('/api/offices', {
                    success(response) {
                        const select = $('[name="address"]', screen);
                        log('Success', { response, select });
                        select.append(response.map(office =>
                            $('<option>')
                                .val(office.address)
                                .text(office.address)
                        ));
                    }
                })

                screenInitializersState.isFormInited = true;
            };

            log('Setting inputs');
            $('[name=mark]', screen).val(inputs.mark);
            $('[name=model]', screen).val(inputs.model);
            $('[name=generation]', screen).val(inputs.generation);
        },
    }

    nextButton.on('click', onNextButtonClick);
    prevButton.on('click', onPrevButtonClick);
    steps.on('click', onStepClick);

    update();
    log('END');
}

const baseApiPath = '/local/templates/zeexa/api/index.php?command=api';
const getPath = (path) => {
    const url = new URL(baseApiPath, window.location);
    url.searchParams.append('uri', path);
    return url.toString();
}



const services = {
    auth: {
        tokenName: 'auth_token',
        isLoggedIn() {
            return !!Cookie.get(this.tokenName);
        },
        setToken(token) {
            Cookie.set(this.tokenName, token, {secure: true});
        },
        async sendCode(phone) {
            const response = await axios.post(getPath('/api/auth/send-code'), {
                phone
            });
            return response.data;
        },
        async getToken(phone, code) {
            const response = await axios.post(getPath('/api/auth/token'), {
                phone, code
            });
            return response.data.token;
        },

        modals: {
            phone: () => $('#form-sms'),
            code: () => $('#form-sms-code'),

            showPhone() {
                $.fancybox.open(this.phone());
            },
            showCode(initCounter = false) {
                const modal = this.code();
                $.fancybox.open(modal);
                modal.find('[name=code]').first().focus();

                if (initCounter) {
                    log('Init counter', { initCounter });
                    this.codeStartCounter(modal);
                }
            },
            counter: 0,
            codeStartCounter(modal, 
                onCounterEnd = () => { setTimeout(this.codeStartCounter, 1000) }
            ) {
                const text = $('[data-counter-text]', modal);
                const counter = $('[data-counter]', modal);
                const twoMinutes = 2 * 60 * 1000;
                const timeEnd = Date.now() + twoMinutes;
                log('Start counter', { text, counter, timeEnd });

                text.html('Отправить код повторно <span data-counter>через 1:59</span>');

                const interval = setInterval(() => {
                    const timeLeft = timeEnd - Date.now();
                    this.counter = timeLeft;
                    const timeLeftIso = new Date(timeLeft).toISOString().slice(14, 19);
                    // log('counter', { timeLeftIso, counter });
                    

                    counter.html(`через ${timeLeftIso}`);

                    if (timeLeft > 0) {
                        return;
                    }

                    clearInterval(interval);
                    text.html('Получить код еще раз');
                    onCounterEnd(text, counter);
                    return;
                }, 1000);
            }
        },
    }
}

const initAuth = () => {
    const log = logger('initAuth');
    const loginButton = $('[data-login-button]');
    const phoneForm = services.auth.modals.phone();
    const codeForm = services.auth.modals.code();
    log('START', {
        loginButton,
        phoneForm,
        codeForm
    });

    let currentForm = 'phone';
    const inputs = {};

    const onPhoneKeyUp = (event) => {
        log('Phone keyup', { event, inputs });
        const input = $(event.delegateTarget);
        inputs.phone = input.val();
    }

    const onPhoneFormSubmit = async (event) => {
        log('onPhoneFormSubmit', { event, inputs });
        event.preventDefault();
        phoneForm.find('[name=phone]').removeClass('error');

        try {
            const response = await services.auth.sendCode(inputs.phone);    
            $.fancybox.close();
            services.auth.modals.showCode(true);
        } catch (error) {
            phoneForm.find('[name=phone]').addClass('error');
        }
    }

    const onCodeInputKeyUp = (event) => {
        event.preventDefault();
        const codeInputs = codeForm.find('[name=code]');
        codeInputs.removeClass('error');
        
        inputs.code = codeInputs.map((i, input) => $(input).val()).toArray().join('');
        log('Code keyup', { event, inputs });
    }

    const onCodeFormSubmit = async (event) => {
        log('onCodeFormSubmit', { event, inputs });
        event.preventDefault();
        codeForm.find('[name=code]').removeClass('error');

        try {
            const token = await services.auth.getToken(inputs.phone, inputs.code);
            services.auth.setToken(token);
            location.reload();
        } catch (error) {
            codeForm.find('[name=code]').addClass('error');
        }
    }

    const onLoginButtonClick = (event) => {
        log('onLoginButtonClick', { event, currentForm });
        event.preventDefault();
        if (currentForm == 'phone') {
            services.auth.modals.showPhone();
        }
        else if (currentForm == 'code') {
            services.auth.modals.showCode(true);
        }
    }

    loginButton.on('click', onLoginButtonClick);
    phoneForm.on('submit', onPhoneFormSubmit);
    phoneForm.find('[name=phone]').on('keyup', onPhoneKeyUp);

    codeForm.on('submit', onCodeFormSubmit);
    services.auth.modals.code().find('[name=code]').on('keyup', onCodeInputKeyUp);

    log('END');
}

const initAxios = () => {
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    axios.defaults.headers.common['Content-Type'] = 'application/json';
}

initModules([
    initDebug,
    initSliders,
    initLazyLoad,
    initPhoneMasks,
    initFancyboxSettings,
    initRatingInput,
    initFileInputUpload,
    initCheckboxInputs,
    initAjaxForms,
    initServices,
    initAuth,
    initAxios,
]);