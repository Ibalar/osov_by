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


