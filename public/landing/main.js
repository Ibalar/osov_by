$(document).ready(function () {
    // Инициализация слайдера
    if ($('#slider-1').length) {
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
    }
});

$(document).ready(function () {
    // Инициализация слайдера
    if ($('#gratitude-slider').length) {
        $('#gratitude-slider').slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            infinite: true,
            dots: true,
            arrows: true,
            prevArrow: $('.prev-1'),
            nextArrow: $('.next-1'),
            autoplay: true,
            autoplaySpeed: 3000,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    }
});


$(document).ready(function () {
    if ($('.mask-phone').length) {
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
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const foundationInputs = document.querySelectorAll("input[name='check-type']");
    const serviceInputs = document.querySelectorAll("input[name='check-service']");
    const volumeSlider = document.getElementById("range-slider");
    const volumeInput = document.querySelector(".val2.form-control");
    const totalPriceElement = document.getElementById("total");

    // Check if all required elements exist
    if (!foundationInputs.length || !serviceInputs.length || !volumeSlider || !volumeInput || !totalPriceElement) {
        return;
    }

    function calculateTotal() {
        const checkedFoundation = document.querySelector("input[name='check-type']:checked");
        const checkedService = document.querySelector("input[name='check-service']:checked");
        
        if (!checkedFoundation || !checkedService) {
            return;
        }
        
        let foundationPrice = parseFloat(checkedFoundation.value) || 0;
        let serviceMultiplier = parseFloat(checkedService.value) || 1;
        let volume = parseFloat(volumeInput.value) || 0;

        let totalPrice = foundationPrice * serviceMultiplier * volume;
        totalPriceElement.textContent = totalPrice.toLocaleString() + " BYN";
    }

    function syncVolumeInput(event) {
        volumeInput.value = event.target.value;
        calculateTotal();
    }

    function syncVolumeSlider() {
        let value = parseFloat(volumeInput.value);
        if (!isNaN(value) && value >= parseFloat(volumeSlider.min) && value <= parseFloat(volumeSlider.max)) {
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

// Bootstrap 5 Modal Compatibility
// Handle both Bootstrap 4 (data-toggle/data-target) and Bootstrap 5 (data-bs-toggle/data-bs-target) syntax
document.addEventListener("DOMContentLoaded", function () {
    // Convert Bootstrap 4 modal triggers to Bootstrap 5 format
    document.querySelectorAll('[data-toggle="modal"]').forEach(function (element) {
        const target = element.getAttribute('data-target');
        if (target && !element.hasAttribute('data-bs-toggle')) {
            element.setAttribute('data-bs-toggle', 'modal');
            element.setAttribute('data-bs-target', target);
        }
    });

    // Convert Bootstrap 4 dismiss buttons to Bootstrap 5 format
    document.querySelectorAll('[data-dismiss="modal"]').forEach(function (element) {
        if (!element.hasAttribute('data-bs-dismiss')) {
            element.setAttribute('data-bs-dismiss', 'modal');
        }
    });

    // Handle modal trigger buttons with dynamic data
    document.querySelectorAll('[data-target^="#"], [data-bs-target^="#"]').forEach(function (element) {
        element.addEventListener('click', function (e) {
            const target = this.getAttribute('data-target') || this.getAttribute('data-bs-target');
            if (target && target.startsWith('#')) {
                const modalElement = document.querySelector(target);
                if (modalElement && typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                    e.preventDefault();
                    
                    // Handle data-title and data-theme attributes
                    const title = this.getAttribute('data-title');
                    const theme = this.getAttribute('data-theme');
                    const flength = this.getAttribute('data-flength');
                    const fwidth = this.getAttribute('data-fwidth');
                    
                    if (title) {
                        const titleElement = modalElement.querySelector('.form-block__title');
                        if (titleElement) {
                            titleElement.innerHTML = title;
                        }
                    }
                    
                    if (theme) {
                        const themeInput = modalElement.querySelector('input[name="theme"]');
                        if (themeInput) {
                            themeInput.value = theme;
                        }
                    }
                    
                    if (flength) {
                        const flengthElement = modalElement.querySelector('#flength');
                        const flengthInput = modalElement.querySelector('#flengthinput');
                        if (flengthElement) flengthElement.textContent = flength;
                        if (flengthInput) flengthInput.value = flength;
                    }
                    
                    if (fwidth) {
                        const fwidthElement = modalElement.querySelector('#fwidth');
                        const fwidthInput = modalElement.querySelector('#fwidthinput');
                        if (fwidthElement) fwidthElement.textContent = fwidth;
                        if (fwidthInput) fwidthInput.value = fwidth;
                    }
                    
                    const modal = bootstrap.Modal.getOrCreateInstance(modalElement);
                    modal.show();
                }
            }
        });
    });
});

// Range slider sync function (global)
function getVals(input) {
    const parent = input.closest('.range-slider');
    if (!parent) return;
    
    const slider = parent.querySelectorAll('input[type="range"]');
    const display = parent.querySelector('.range-value');
    
    if (slider.length > 1) {
        // Dual range slider
        const slide1 = parseFloat(slider[0].value);
        const slide2 = parseFloat(slider[1].value);
        if (slide1 > slide2) {
            // Swap if needed
            input.value = input === slider[0] ? slide2 : slide1;
        }
    }
    
    if (display) {
        display.textContent = input.value;
    }
    
    // Trigger calculation if calculator exists
    const event = new Event('input', { bubbles: true });
    input.dispatchEvent(event);
}
