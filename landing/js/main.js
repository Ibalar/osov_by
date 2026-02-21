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

// AJAX form submission for js-telegram-form
$(document).ready(function () {
    $('form.js-telegram-form').on('submit', function (e) {
        e.preventDefault();

        const $form = $(this);
        const $button = $form.find('button[type="submit"]');
        const originalButtonText = $button.text();
        const url = $form.attr('action');

        // Validate required fields
        let isValid = true;
        $form.find('.required').each(function () {
            const $field = $(this);
            if ($field.attr('type') === 'checkbox') {
                if (!$field.is(':checked')) {
                    isValid = false;
                }
            } else {
                if (!$field.val() || $field.val() === '0') {
                    isValid = false;
                }
            }
        });

        if (!isValid) {
            alert('Пожалуйста, заполните все обязательные поля.');
            return;
        }

        // Disable button and show loading
        $button.prop('disabled', true).text('Отправка...');

        $.ajax({
            url: url,
            type: 'POST',
            data: $form.serialize(),
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    // Hide form fields and show success message
                    $form.find('.form__fields').addClass('form__hide-success');
                    $form.find('.form__success').removeClass('form__hide-success');
                    $form[0].reset();
                } else {
                    alert(response.message || 'Произошла ошибка. Пожалуйста, попробуйте еще раз.');
                }
            },
            error: function (xhr, status, error) {
                console.error('Form submission error:', error);
                let message = 'Произошла ошибка. Пожалуйста, попробуйте еще раз.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                    const errors = Object.values(xhr.responseJSON.errors).flat();
                    message = errors.join('\n');
                }
                alert(message);
            },
            complete: function () {
                // Re-enable button
                $button.prop('disabled', false).text(originalButtonText);
            }
        });
    });
});


