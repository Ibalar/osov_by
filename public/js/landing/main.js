// Установка CSRF токена для всех AJAX запросов
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    // Инициализация слайдера
    $('#slider-1').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: true,
        arrows: true,
        prevArrow: $('.prev-1'),
        nextArrow: $('.next-1'),
        autoplay: true,
        autoplaySpeed: 3000
    });
});

$(document).ready(function () {
    // Инициализация слайдера
    $('#gratitude-slider').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
        dots: true,
        arrows: true,
        prevArrow: $('.prev-1'),
        nextArrow: $('.next-1'),
        autoplay: true,
        autoplaySpeed: 3000
    });
});


$(document).ready(function () {
    $(".mask-phone").inputmask({
        mask: "+375 (99) 999-99-99",
        placeholder: "_",
        showMaskOnHover: false,
        clearIncomplete: true
    });

    $(".mask-phone").on("blur", function () {
        let phone = $(this).val();
        let validCodes = ["25", "29", "33", "44"]; // Разрешённые коды
        let enteredCode = phone.substring(6, 8); // Извлекаем код

        if (!validCodes.includes(enteredCode)) {
            alert("Введите номер с кодом 25, 29, 33 или 44!");
            $(this).val(""); // Очищаем поле
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const foundationInputs = document.querySelectorAll("input[name='check-type']");
    const serviceInputs = document.querySelectorAll("input[name='check-service']");
    const volumeSlider = document.getElementById("range-slider");
    const volumeInput = document.querySelector(".val2.form-control");
    const totalPriceElement = document.getElementById("total");

    function calculateTotal() {
        let foundationPrice = document.querySelector("input[name='check-type']:checked").value;
        let serviceMultiplier = document.querySelector("input[name='check-service']:checked").value;
        let volume = parseFloat(volumeInput.value) || 0; // Получаем объем из текстового поля

        let totalPrice = foundationPrice * serviceMultiplier * volume;
        totalPriceElement.textContent = totalPrice.toLocaleString() + " BYN";
    }

    function syncVolumeInput(event) {
        volumeInput.value = event.target.value;
        calculateTotal();
    }

    function syncVolumeSlider() {
        let value = parseFloat(volumeInput.value);
        if (!isNaN(value) && value >= volumeSlider.min && value <= volumeSlider.max) {
            volumeSlider.value = value;
            calculateTotal();
        }
    }

    // Обработчики событий
    foundationInputs.forEach(input => input.addEventListener("change", calculateTotal));
    serviceInputs.forEach(input => input.addEventListener("change", calculateTotal));
    volumeSlider.addEventListener("input", syncVolumeInput);
    volumeInput.addEventListener("input", syncVolumeSlider);

    // Инициализация при загрузке страницы
    calculateTotal();
});

// AJAX форма заявки (header_form / js-telegram-form)
$(document).ready(function () {
    // Обработчик для форм заявок с header_form или js-telegram-form
    $('form[name="header_form"], form.js-telegram-form').on('submit', function (e) {
        e.preventDefault();

        const form = $(this);
        const formContainer = form.closest('.form-block');
        const submitBtn = form.find('button[type="submit"]');
        const originalBtnText = submitBtn.text();

        // Валидация checkbox
        const checkbox = form.find('input[type="checkbox"]');
        if (checkbox.length > 0 && !checkbox.is(':checked')) {
            alert('Пожалуйста, согласитесь с политикой обработки персональных данных');
            return;
        }

        // Проверка номера телефона
        const phoneInput = form.find('input[name="phone"]');
        if (phoneInput.length > 0) {
            const phone = phoneInput.val();
            if (!phone || phone.length < 10) {
                alert('Пожалуйста, введите номер телефона');
                phoneInput.focus();
                return;
            }
        }

        // Блокируем кнопку и показываем загрузку
        submitBtn.prop('disabled', true).text('Отправка...');

        // Собираем данные формы
        const formData = new FormData(form[0]);

        // Отправляем AJAX запрос
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    // Показываем сообщение об успехе
                    form.find('.form__fields').hide();
                    form.find('.form__hide-success').hide();

                    // Добавляем блок с успехом
                    const successHtml = `
                        <div class="form-block__success" style="text-align: center; padding: 20px;">
                            <div style="font-size: 48px; margin-bottom: 16px;">✅</div>
                            <h3 style="color: #28a745; margin-bottom: 12px;">${response.message || 'Спасибо! Ваша заявка принята.'}</h3>
                            <p style="color: #666;">Мы свяжемся с вами в ближайшее время.</p>
                        </div>
                    `;

                    if (form.find('.form-block__success').length === 0) {
                        form.append(successHtml);
                    }

                    // Очищаем форму
                    form[0].reset();

                    // Сбрасываем маску телефона
                    if (phoneInput.length > 0) {
                        phoneInput.val('');
                    }
                } else {
                    alert(response.message || 'Произошла ошибка. Попробуйте позже.');
                    submitBtn.prop('disabled', false).text(originalBtnText);
                }
            },
            error: function (xhr) {
                let errorMessage = 'Произошла ошибка. Попробуйте позже.';

                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    const errors = xhr.responseJSON.errors;
                    const firstError = Object.values(errors)[0];
                    if (Array.isArray(firstError)) {
                        errorMessage = firstError[0];
                    }
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }

                alert(errorMessage);
                submitBtn.prop('disabled', false).text(originalBtnText);
            }
        });
    });
});


