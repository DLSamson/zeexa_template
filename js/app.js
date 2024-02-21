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

    ajaxForms.filter((i, form) => {
        return !!$(form).data('command');
    }).on('submit', onAjaxFormSubmit);

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
        currentStep: 1,
        currentMaxStep: 1,
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

    const onNextButtonClick = async (event) => {
        event?.preventDefault();

        if (state.currentStep == state.maxScreens) {
            if (!(await services.auth.isLoggedIn())) {
                $.fancybox.open(services.auth.modals.showPhone());
                return;
            }

            nextButton.attr('disabled', true);
            fetchNivusApi(`/api/maintance`, {
                data: JSON.stringify(inputs),
                method: 'POST',
                success(response) {
                    const modal = $('<div>')
                        .addClass('ajax-form')
                        .addClass('services-modal')
                        .text('Вы успешно записались');

                    $.fancybox.open($(response.form));
                },
                error() {
                    const modal = $('<div>')
                        .addClass('ajax-form')
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
                        inputs.services.push(input.data('id'));
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
        2: (screen) => {
            log('Inputs', { inputs });
            if (!screenInitializersState.isFormInited) {
                const onChange = (event) => {
                    const target = $(event.delegateTarget);
                    log('Input change', { target, event, inputs });
                    inputs[target.attr('name')] = $(event.delegateTarget).val();
                };
                $('[name=carId]', screen).on('change', onChange);
                $('[name=officeId]', screen).on('change', onChange);
                $('[name=date]', screen).on('change', onChange);
                $('[name=time]', screen).on('change', onChange);
                $('[name=comment]', screen).on('change', onChange);

                screenInitializersState.isFormInited = true;
            };
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


let user = null;
let phone = null;
const services = {
    auth: {
        tokenName: 'auth_token',
        async getUser() {
            log('getUser', { tokenName: this.tokenName });
            try {
                const response = await axios.get(getPath('/api/auth/user'));
                log('getUser response', { response });
                return response.data;
            }
            catch (error) {
                log('getUser error', {error})
                return false;
            }
        },
        async isLoggedIn() {
            return !!(await this.getUser());
        },
        setToken(token) {
            log('setToken', { token, tokenName: this.tokenName });
            Cookies.set(this.tokenName, token, {secure: true});
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
            log('getToken', { response });
            return response.data.token;
        },


        modals: {
            phone: () => $('#form-sms'),
            code: () => $('#form-sms-code'),
            info: () => $('#form-sms-info'),

            showInfo() {
                log('showInfo');
                $.fancybox.close();
                $.fancybox.open(this.info());
            },

            showPhone() {
                log('showPhone');
                $.fancybox.close();
                $.fancybox.open(this.phone());
            },
            showCode(initCounter = false) {
                log('showCode');
                $.fancybox.close();
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
                onCounterEnd = () => {
                    setTimeout(() => {
                        services.auth.sendCode(phone);
                        this.codeStartCounter()
                }, 1000) }
            ) {
                const text = $('[data-counter-text]', modal);
                const twoMinutes = 2 * 60 * 1000;
                const timeEnd = Date.now() + twoMinutes;
                if (this.counter > 0) return;
                
                log('Start counter', { text, timeEnd });

                text.html('Отправить код повторно <span data-counter>через 1:59</span>');

                const interval = setInterval(() => {
                    const timeLeft = timeEnd - Date.now();
                    const timeCounter = $('[data-counter]', text);
                    this.counter = timeLeft;
                    const timeLeftIso = new Date(timeLeft).toISOString().slice(14, 19);

                    log('counter', { timeLeftIso, timeCounter });
                    timeCounter.text(`через ${timeLeftIso}`);

                    if (timeLeft > 0) {
                        return;
                    }

                    clearInterval(interval);
                    text.html('Получить код еще раз');

                    text.on('click', () => {
                        if (this.counter > 0) return;

                        onCounterEnd();
                    });
                    return;
                }, 1000);
            }
        },

        user: {
            update(data) {
                const path = getPath('/api/auth/user/update');
                return axios.post(path, data);
            },
        }
    }
}

const initAuth = () => {
    const log = logger('initAuth');
    const loginButton = $('[data-login-button]');
    const phoneForm = services.auth.modals.phone();
    const codeForm = services.auth.modals.code();
    const infoForm = services.auth.modals.info();
    log('START', {
        loginButton,
        phoneForm,
        codeForm,
        infoForm,
    });

    let currentForm = 'phone';
    const inputs = {};

    const onPhoneKeyUp = (event) => {
        log('Phone keyup', { event, inputs });
        const input = $(event.delegateTarget);
        inputs.phone = input.val();
        phone = input.val();
    }

    const onPhoneFormSubmit = async (event) => {
        log('onPhoneFormSubmit', { event, inputs });
        event.preventDefault();
        phoneForm.find('[name=phone]').removeClass('error');

        try {
            const response = await services.auth.sendCode(inputs.phone);    
            currentForm = 'code';
            services.auth.modals.showCode(true);
        } catch (error) {
            phoneForm.find('[name=phone]').addClass('error');
        }
    }

    let currentCodeInputCount = 0;
    const onCodeInputKeyUp = (event) => {
        event.preventDefault();

        const codeInputs = codeForm.find('[name=code]');
        codeInputs.removeClass('error');

        log('Code keyup', { event, codeInputs, currentCodeInputCount });
        if(event.originalEvent.key == 'Backspace') {
            if(currentCodeInputCount != 0) {
                currentCodeInputCount--;
            }
        }
        else {
            if(currentCodeInputCount != 3) {
                currentCodeInputCount++;
            }
        }

        const currentCodeInput = codeInputs
            .filter((i, element) =>
                $(element).data('code') == currentCodeInputCount || $(element).val() == '')
            .first();
        
        currentCodeInput.focus();
        log('Code keyup', { event, inputs, currentCodeInput});
    }

    const onCodeFormSubmit = async (event) => {
        log('onCodeFormSubmit', { event, inputs });
        event.preventDefault();
        codeForm.find('[name=code]').removeClass('error');

        const codeInputs = codeForm.find('[name=code]');
        inputs.code = codeInputs
            .map((i, input) => $(input).val())
            .toArray()
            .join('');

        try {
            const token = await services.auth.getToken(inputs.phone, inputs.code);
            services.auth.setToken(token);
            const user = await services.auth.getUser();
            
            const createdAt = new Date(user.createdAt);
            if(Date.now() - createdAt.getTime() < 60 * 60) {
                services.auth.modals.showInfo();
                return;
            }
            window.location.reload();
        } catch (error) {
            codeForm.find('[name=code]').addClass('error');
        }
    }


    const onGenderClick = (event) => {
        log('onSexClick', { event, inputs });
        const buttons = $('.nivus__box-btn');
        const target = $(event.delegateTarget);
        inputs.gender = target.data('gender');
        
        buttons.addClass('nivus__box-btn--disabled');
        target.removeClass('nivus__box-btn--disabled');
    }
    const onInfoFormSubmit = (event) => {
        event.preventDefault();
        infoForm.find('input').removeClass('error');
        const data = infoForm.serializeArray();
        data.push({ name: 'gender', value: inputs.gender ?? 'M' });

        const actualData = {};
        data.map((x) => { actualData[x.name] = x.value });
        actualData['phone'] = inputs.phone ?? user.phoneNumber;

        log('onInfoFormSubmit', { event, inputs, data, actualData, infoForm });
        services.auth.user.update(actualData)
            .then(response => {
                user = response.data;
                $.fancybox.close();
            })
            .catch(error => {
                log('onInfoFormSubmit Error', {error, inputs: infoForm.find('input')})
                infoForm.find('label').addClass('error');   
            });
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
        else if (currentForm == 'info') {
            services.auth.modals.showInfo();
        }
    }

    loginButton.on('click', onLoginButtonClick);
    phoneForm.on('submit', onPhoneFormSubmit);
    phoneForm.find('[name=phone-code]').on('keyup', onPhoneKeyUp);

    codeForm.on('submit', onCodeFormSubmit);
    services.auth.modals.code().find('[name=code]').on('keyup', onCodeInputKeyUp);

    infoForm.on('submit', onInfoFormSubmit);
    infoForm.find('[data-gender]').on('click', onGenderClick);

    log('END');
}

const initAxios = async () => {
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    axios.defaults.headers.common['Content-Type'] = 'application/json';
    user = await services.auth.getUser();
}

const initSelect = () => {
    const log = logger('Init Select');

    const dropdowns = $('[data-dropdown]');
    dropdowns.each((i, dropdown) => {
        dropdown = $(dropdown);
        const current = $('[data-dropdown-current]', dropdown);
        const search = $('[data-dropdown-search]', dropdown);
        const list = $('[data-dropdown-list]', dropdown);
        log('dropdown', { dropdown, current, search, list });

        // const onOuterClick = (event) => {
        //     //bug
        //     log('onOuterClick', { event, dropdown });
        //     if (event.target.contains(dropdown[0])) return;

        //     list.hide();
        //     search.hide();
        // }

        const onSearchKeyup = (event) => {
            const listItems = $(list).children();
            const searchValue = search.val().toLowerCase();
            log('onSearchKeyup', { event, list, listItems, searchValue });
            listItems.show();

            listItems.filter((i, item) =>
                !$(item).text().toLowerCase().includes(searchValue)).hide();
        }

        const onDropDownClick = (event) => {
            log('onDropDownClick', { event, list, current, dropdown });
            if (event.target == dropdown[0] || event.target == current[0]) {
                list.toggle();
                search.toggle();
            }
        }

        const onListItemClick = (event) => {
            const target = $(event.currentTarget);
            log('onListItemClick', { event, list, current, dropdown, target });
            current.text(target.text());
            list.hide();
            search.hide();
        }

        dropdown.on('click', onDropDownClick);
        list.on('click', 'li', onListItemClick);
        search.on('keyup', onSearchKeyup);
        // $(window).on('click', onOuterClick);
    });
}

const initAddCarForm = () => {
    const log = logger('initAddCarForm');
    const form = $('#form-add-car');
    const brands = $('[data-dropdown=brands]');
    const models = $('[data-dropdown=models]');
    const serials = $('[data-dropdown=serials]');
    const loader = $('.loader', form);

    const inputs = {

    }


    const onGosNumberInput = (event) => {
        inputs['govNumber'] = $(event.delegateTarget).val();
    }

    const onFormSubmit = (event) => {
        event.preventDefault();

        log('Form Submit', {form, inputs});
        fetchNivusApi('/api/cars/my', {
            data: JSON.stringify({
                serial: inputs.serial,
                govNumber: inputs.govNumber,
            }),
            method: 'POST',
            success() {
                $.fancybox.close();
                const form =
                    $('<div>')
                        .addClass('ajax-form')
                        .text('Ваша машина успешно добавлена');
                $.fancybox.open(form);
                setTimeout(() => {
                    const url = new URL(window.location);
                    url.searchParams.append('screen', 'garage');

                    window.location = url;
                }, 3000);
            }
        })
    }

    form.find('input[name=gos-number]').on('keyup', onGosNumberInput);
    form.on('submit', onFormSubmit);

    const onModelSelect = () => {
        serials.parents('label').show();
        loader.show();
        serials.find('[data-dropdown-list]').empty();
        fetchNivusApi('/api/serials', {
            data: {
                model: inputs.model.id
            },
            success(response) {
                log('Serial Response', {response})
                serials.find('[data-dropdown-list]')
                    .append(
                        response.map(serial => 
                            $('<li>')
                                .text(serial.name)
                                .on('click', () => {
                                    inputs.serial = serial;
                                })
                        ) 
                )
                loader.hide();
            }
        });
    }

    const onBrandSelect = () => {
        models.parents('label').show();
        loader.show();
        models.find('[data-dropdown-list]').empty();
        fetchNivusApi('/api/models', {
            data: {
                brand: inputs.brand.id
            },
            success(response) {
                log('Model Response', {response})
                models.find('[data-dropdown-list]')
                    .append(
                        response.map(model => 
                            $('<li>')
                                .text(model.name)
                                .on('click', () => {
                                    inputs.model = model;
                                    onModelSelect();
                                })
                        ) 
                )
                loader.hide();
            }
        });
    }

    loader.show();
    fetchNivusApi('/api/brands', {
        success(response) {
            log('Brand Response', {response})
            brands.find('[data-dropdown-list]')
                .append(
                    response.map(brand => 
                        $('<li>')
                            .text(brand.name)
                            .on('click', () => {
                                inputs.brand = brand;
                                onBrandSelect()
                            })
                    ) 
            )
            loader.hide();
        }
    });
}


const initAddMaintanceForm = () => {
    const log = logger('initAddMaintanceForm');
    const formCar = $('#form-add-maintance-car');
    const formServices = $('#form-add-maintance-services');
    const formOffices = $('#form-add-maintance-offices');

    if (
        formCar.length === 0
        || formServices.length === 0
        || formOffices.length === 0
    ) {
        log('Cannot find forms', {
            formCar,
            formServices,
            formOffices
        })
        return;
    };

    const inputs = {
        carId: null,
        officeId: null,
        services: [],
    }

    const carItems = formCar.find('.entry-page__inner');
    const onCarItemClick = (event) => {
        const item = $(event.delegateTarget);
        inputs.carId = item.data('car-id');
        log('onItemClick', { item, inputs });

        carItems.removeClass('active');
        item.addClass('active');
    }
    carItems.on('click', onCarItemClick);

    formCar.on('submit', (event) => {
        event.preventDefault();
        if (!inputs.carId) return;
        $.fancybox.close();
        $.fancybox.open(formServices);
    });

    formServices.on('submit', (event) => {
        event.preventDefault();

        const services = [];
        formServices.find('[name=service]:checked').each((i, el) => {
            services.push($(el).val());
        });
        inputs.services = services;

        $.fancybox.close();
        $.fancybox.open(formOffices);
    });

    const serviceGroups = formServices.find('.stock-item');
    const searchInput = $('input[name=search]', formServices);

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
                const text = $(service).find('input').attr('data-name');
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

    formOffices.on('submit', (event) => {
        event.preventDefault();
        const formInputs = Object.assign(inputs, Object.fromEntries(new FormData(formOffices[0]).entries()));

        fetchNivusApi('/api/maintance', {
            data: JSON.stringify(formInputs),
            method: 'POST',
            success(response) {
                log('Response', response);
                const formSuccess = response.form;
                $.fancybox.close();
                $.fancybox.open($(formSuccess));
            }
        })

        log('onSubmit', { formInputs, inputs });
    });

    $('[data-add-maintance-car]').on('click', ({delegateTarget}) => {
        inputs.carId = $(delegateTarget).data('car-id');
    });

    log('END', { carItems, formCar, formServices, formOffices, inputs, searchInput, serviceGroups });
}

const initCancelMaintanceButton = () => {
    const buttons = $('[data-maintance-cancel]');

    buttons.each((i, button) => {
        const id = $(button).data('maintance-cancel');
        $(button).on('click', (event) => {
            event.preventDefault();
            fetchNivusApi('/api/maintance/cancel', {
                data: JSON.stringify({ id }),
                method: 'POST',
                success(response) {
                    log('Response', response);
                    $.fancyvox.close();
                    f.fancyvox.open(
                        $('#form-maintance-canceled')
                    );
                }
            })
        })
    })
}

const initMaintanceMapForElement = (element) => {
    const data = {
        latitude: element.data('latitude'),
        longitude: element.data('longitude'),
        title: element.data('title'),
        id: element.data('id')
    }
    log('initMaintanceMapForElement', { element, data });

    const init = (data) => {
        let myMap = new ymaps.Map(data.id, {
            center: [data.latitude, data.longitude],
            zoom: 10
        }, {
            searchControlProvider: 'yandex#search'
        });
    
        myMap.geoObjects
            .add(ymaps.Placemark([data.latitude, data.longitude], {
                balloonContent: data.title
            }, {
                preset: 'islands#icon',
                iconColor: '#C63235'
            }));
        myMap.controls.remove('searchControl')
    }

    ymaps.ready(() => init(data));
}

const initMaintanceMapElements = () => {
    const maps = $('.maintance-maps');
    log('initMaintanceMapElements', { maps });
    maps.each((i, element) => initMaintanceMapForElement($(element)));
}

const initHeaderForm = () => {
    const form = $('#header-form');

    log('initHeaderForm', { form });

    const values = $('[data-dropdown-list] > li', form);
    values.on('click', ({ delegateTarget }) => {
        const parent = $(delegateTarget).parents('[data-dropdown]');
        const name = parent.find('[data-dropdown-current]').attr('data-dropdown-current');
        const input = form
            .find(`input[name=${name}]`)
            .val($(delegateTarget).text());

        log('dropdown change', {delegateTarget, parent, name, input});
    });
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
    initSelect,
    initHeaderForm,
    initAddCarForm,
    initAddMaintanceForm,
    initMaintanceMapElements,
]);