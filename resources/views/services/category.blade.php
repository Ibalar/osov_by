@extends('layouts.app')

@section('content')

    {{-- Hero Section --}}
    @if($category->hero_title || !empty($category->hero_items))
    <header class="header">
        <div class="header-body">
            <div class="header-body__img"></div>
            <div class="container header-body__box">
                <div class="row">
                    <div class="col-lg-6 p-md-0">
                        <h1 class="title header-body__title">
                            {{ $category->hero_title ?? $category->title }}
                        </h1>
                        @if($category->hero_subtitle)
                        <h3 class="header-body__subtitle">
                            {{ $category->hero_subtitle }}
                        </h3>
                        @endif
                        @if(!empty($category->hero_items))
                        <div class="header-body__container">
                            @foreach($category->hero_items as $item)
                            <div class="header-body__item">
                                <p>{!! $item['text'] ?? '' !!}</p>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>

                    {{-- Форма заявки --}}
                    <div class="col-lg-6 p-0 p-sm-2 p-md-0 pr-lg-0">
                        <div class="offset-xl-3 offset-md-2 offset-lg-0 col-md-8 col-lg-12 col-xl-9 mt-4 mt-lg-0 p-0">
                            <div class="form-block b header-body__form rf">
                                <form action="{{ route('api.foundation-request.store') }}" method="POST" class="form-block__container n form__form callback-form js-telegram-form" name="header_form">
                                    @csrf
                                    <fieldset class="form__fields form__hide-success">
                                        <h3 class="form-block__title">Оставьте <span>заявку</span></h3>

                                        <div class="form-block__input">
                                            <input class="mask-phone zphone required" name="phone" type="tel" placeholder="Номер телефона +375...">
                                        </div>
                                        <br>
                                        <div class="form-block__button">
                                            <button type="submit" class="button animat-2 feedback">Отправить заявку</button>
                                        </div>

                                        <div class="form-block__checkbox">
                                            <label class="check">
                                                <input class="check__input required" type="checkbox" checked="">
                                                <span class="check__box"></span>
                                            </label>
                                            <p>Я согласен(а) с <a href="{{ route('page.show', 'privacy') }}">политикой обработки персональных данных</a></p>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    @endif

    <div class="page-single-post">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <!-- Post Single Content Start -->

                    @if(!empty($category->description))
                        <div class="post-content">
                            <div class="post-entry">
                                {!! $category->description !!}
                            </div>
                        </div>
                    @endif

                    {{-- Types Section --}}
                    @if(!empty($category->types))
                        <div class="apartments-plans">
                            <div class="container">
                                <div class="row section-row">
                                    <div class="col-xl-12">
                                        <!-- Section Title Start -->
                                        <div class="section-title section-title-center">
                                            <h2 class="text-anime-style-3" data-cursor="-opaque">{{ $category->types_title ?? 'Типы' }}</h2>
                                        </div>
                                        <!-- Section Title End -->
                                    </div>
                                </div>

                                <div class="row">
                                    @foreach($category->types_images_urls ?? [] as $index => $type)
                                    <div class="col-xl-4 col-md-6">
                                        <!-- Apartments Plan Item Start -->
                                        <div class="apartments-plan-item wow fadeInUp">
                                            <!-- Apartments Plan Item Content Start -->
                                            <div class="apartments-plan-item-content">
                                                <h3>{!! $type['title'] ?? '' !!}</h3>
                                            </div>
                                            <!-- Apartments Plan Item Content End -->

                                            <!-- Apartments Plan Item Image Start -->
                                            @if(isset($type['image_url']))
                                            <div class="apartments-plan-item-image">
                                                <figure>
                                                    <img src="{{ asset('storage/' . $type['image']) }}" alt="{{ $type['title'] ?? '' }}">
                                                </figure>
                                            </div>
                                            @endif
                                            <!-- Apartments Plan Item Image End -->

                                            <!-- Apartments Amenity List Start -->
                                            <div class="apartments-plan-item-list">
                                                <ul>
                                                    <li><span><img src="{{ asset('images/icon-apartments-amenity-2.svg') }}" alt="Цена от">Стоимость</span>от {!! $type['price'] ?? '' !!} BYN/м³</li>
                                                </ul>
                                            </div>
                                            <!-- Apartments Amenity List End -->
                                        </div>
                                        <!-- Apartments Plan Item End -->
                                    </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    @endif

                    {{-- Examples Section --}}
                    @if(!empty($category->examples))
                    <section id="examples" class="examples" style="margin-top: 4rem;">
                        <div class="container">
                            <h2 class="title one">{{ $category->examples_title ?? 'Выполненные работы' }}</h2>
                            <div class="row">
                                @foreach($category->examples_images_urls ?? [] as $example)
                                <div class="col-md-6 col-lg-4 p-md-0 mb-4">
                                    <div class="examples__item">
                                        @if(isset($example['image_url']))
                                        <div class="examples__img">
                                            <img src="{{ $example['image_url'] }}" alt="{{ $example['title'] ?? '' }}">
                                        </div>
                                        @endif
                                        <div class="examples__content">
                                            <h3>{{ $example['title'] ?? '' }}</h3>
                                            @if(isset($example['description']))
                                            <p>{{ $example['description'] }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                    @endif

                    {{-- Gallery Section --}}
                    @if(!empty($category->gallery_images))
                    <section id="gallery" class="gallery" style="margin-top: 4rem;">
                        <div class="container">
                            <h2 class="title one">{{ $category->gallery_title ?? 'Галерея' }}</h2>
                            <div class="row">
                                @foreach($category->gallery_images_urls ?? [] as $image)
                                <div class="col-md-6 col-lg-4 p-md-0 mb-4">
                                    <a href="{{ $image }}" data-fancybox="gallery" class="gallery__item">
                                        <img src="{{ $image }}" alt="Галерея">
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                    @endif

                    {{-- Price Table Section --}}
                    @if(!empty($category->price_table))
                    <section id="price" class="price" style="margin-top: 4rem;">
                        <div class="container">
                            <h2 class="title one">{{ $category->price_title ?? 'Цены' }}</h2>
                            <div class="price__table">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            @if(!empty($category->price_table[0]))
                                            @foreach(array_keys($category->price_table[0]) as $header)
                                            <th>{{ $header }}</th>
                                            @endforeach
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($category->price_table as $row)
                                        <tr>
                                            @foreach($row as $cell)
                                                <td>{!! is_array($cell) ? trim(implode(', ', Arr::flatten($cell))) : $cell !!}</td>
                                            @endforeach
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                    @endif

                    <!-- Universal Calculator Section -->
                    @if($category->calculator_enabled && !empty($category->calculator_fields))
                        <div class="our-amenities-prime bg-section calculator-section" style="margin-top: 4rem;">
                            <div class="container">
                                <div class="row section-row">
                                    <div class="col-lg-12">
                                        <div class="section-title">
                                            <span class="section-sub-title wow fadeInUp fs-6">Калькулятор</span>
                                            <h2 class="text-anime-style-3" data-cursor="-opaque">
                                                {{ $category->calculator_title ?? 'Калькулятор стоимости услуг' }}
                                            </h2>
                                            @if($category->calculator_description)
                                                <div class="calculator-description mt-3">
                                                    {!! $category->calculator_description !!}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="calculator-container">
                                            <form id="universal-calculator" class="calculator-form">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        @foreach($category->calculator_fields as $fieldIndex => $field)
                                                            <div class="calculator-field mb-3">
                                                                <label for="calc-field-{{ $fieldIndex }}" class="form-label">
                                                                    {{ $field['label'] ?? '' }}
                                                                </label>

                                                                @php
                                                                    $fieldKey = $field['key'] ?? 'field_' . $fieldIndex;
                                                                    $fieldType = $field['type'] ?? 'number';
                                                                    $defaultValue = $field['default_value'] ?? '';
                                                                    $placeholder = $field['placeholder'] ?? '';
                                                                    $min = $field['min'] ?? '';
                                                                    $max = $field['max'] ?? '';
                                                                    $step = $field['step'] ?? '';
                                                                    $options = $field['options'] ?? [];
                                                                @endphp

                                                                @if($fieldType === 'select' || $fieldType === 'radio')
                                                                    @foreach($options as $optionIndex => $option)
                                                                        @php
                                                                            $optionKey = $fieldKey . '_' . $optionIndex;
                                                                            $optionValue = $option['value'] ?? '';
                                                                            $optionLabel = $option['label'] ?? '';
                                                                            $isFirst = $loop->first;
                                                                        @endphp

                                                                        @if($fieldType === 'radio')
                                                                            <div class="form-check">
                                                                                <input class="form-check-input calculator-input"
                                                                                       type="radio"
                                                                                       name="{{ $fieldKey }}"
                                                                                       id="{{ $optionKey }}"
                                                                                       value="{{ $optionValue }}"
                                                                                       data-field-key="{{ $fieldKey }}"
                                                                                       {{ $isFirst ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="{{ $optionKey }}">
                                                                                    {{ $optionLabel }}
                                                                                </label>
                                                                            </div>
                                                                        @else
                                                                            <select class="form-select calculator-input"
                                                                                    id="calc-field-{{ $fieldIndex }}"
                                                                                    name="{{ $fieldKey }}"
                                                                                    data-field-key="{{ $fieldKey }}">
                                                                                <option value="">Выберите...</option>
                                                                                <option value="{{ $optionValue }}" {{ $isFirst ? 'selected' : '' }}>
                                                                                    {{ $optionLabel }}
                                                                                </option>
                                                                            </select>
                                                                        @endif
                                                                    @endforeach
                                                                @elseif($fieldType === 'checkbox')
                                                                    <div class="form-check">
                                                                        <input class="form-check-input calculator-input"
                                                                               type="checkbox"
                                                                               id="calc-field-{{ $fieldIndex }}"
                                                                               name="{{ $fieldKey }}"
                                                                               value="1"
                                                                               data-field-key="{{ $fieldKey }}"
                                                                               {{ $defaultValue ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="calc-field-{{ $fieldIndex }}">
                                                                            {{ $field['checkbox_label'] ?? $field['label'] ?? '' }}
                                                                        </label>
                                                                    </div>
                                                                @elseif($fieldType === 'range')
                                                                    <div class="range-slider-wrapper">
                                                                        <input type="range"
                                                                               class="form-range calculator-input"
                                                                               id="calc-field-{{ $fieldIndex }}"
                                                                               name="{{ $fieldKey }}"
                                                                               data-field-key="{{ $fieldKey }}"
                                                                               min="{{ $min }}"
                                                                               max="{{ $max }}"
                                                                               step="{{ $step }}"
                                                                               value="{{ $defaultValue }}">
                                                                        <div class="range-value-display">
                                                                            <span class="range-value">{{ $defaultValue }}</span>
                                                                            <span class="range-unit">{{ $field['unit'] ?? '' }}</span>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <input type="{{ $fieldType }}"
                                                                           class="form-control calculator-input"
                                                                           id="calc-field-{{ $fieldIndex }}"
                                                                           name="{{ $fieldKey }}"
                                                                           data-field-key="{{ $fieldKey }}"
                                                                           placeholder="{{ $placeholder }}"
                                                                           value="{{ $defaultValue }}"
                                                                           @if($min !== '') min="{{ $min }}" @endif
                                                                           @if($max !== '') max="{{ $max }}" @endif
                                                                           @if($step !== '') step="{{ $step }}" @endif>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="calculator-result">
                                                            <div class="result-display">
                                                                <div class="result-label">
                                                                    {{ $category->calculator_result_label ?? 'Итоговая стоимость' }}
                                                                </div>
                                                                <div class="result-value">
                                                                    <span id="calculator-total">0</span>
                                                                    <span class="currency">{{ $category->calculator_currency ?? 'BYN' }}</span>
                                                                </div>
                                                            </div>

                                                            <div class="calculator-actions mt-3">
                                                                <button type="button" class="btn btn-primary" onclick="calculateResult()">
                                                                    Пересчитать
                                                                </button>
                                                                <button type="button" class="btn btn-outline-secondary" onclick="resetCalculator()">
                                                                    Сбросить
                                                                </button>
                                                            </div>

                                                            @if($category->calculator_formula)
                                                                <div class="formula-display mt-3">
                                                                    <small class="text-muted">
                                                                        Формула: {{ $category->calculator_formula }}
                                                                    </small>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Reviews Section --}}
                    @if(!empty($category->reviews))
                    <section id="gratitude" class="gratitude" style="margin-top: 4rem;">
                        <div class="container">
                            <h2 class="title one">{{ $category->reviews_title ?? 'Отзывы клиентов' }}</h2>
                            <div class="gratitude-slider" id="gratitude-slider">
                                @foreach($category->reviews as $review)
                                <div class="gratitude__item">
                                    <div class="gratitude__content">
                                        <div class="gratitude__text">
                                            {!! $review['text'] ?? '' !!}
                                        </div>
                                        <div class="gratitude__author">
                                            <h4>{{ $review['name'] ?? '' }}</h4>
                                            @if(isset($review['date']))
                                            <p class="gratitude__date">{{ $review['date'] }}</p>
                                            @endif
                                            @if(isset($review['rating']))
                                            <div class="gratitude__rating">
                                                @for($i = 1; $i <= 5; $i++)
                                                <span class="star {{ $i <= $review['rating'] ? 'active' : '' }}">★</span>
                                                @endfor
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="slider-controls">
                                <button class="slider-btn prev-1"><</button>
                                <button class="slider-btn next-1">></button>
                            </div>
                        </div>
                    </section>
                    @endif

                    @php
                        $faqs = [];

                        if(!empty($category->faq)) {
                            $faqs = json_decode($category->faq, true) ?: [];
                        } elseif(!empty($subcategory->faq)) {
                            $faqs = json_decode($subcategory->faq, true) ?: [];
                        }
                    @endphp

                    @if(!empty($faqs))
                        <div class="page-single-faqs">
                            <div class="section-title">
                                <h2 class="text-anime-style-3" data-cursor="-opaque">Популярные вопросы и ответы</h2>
                            </div>
                            <div class="faq-accordion" id="accordion">
                                @foreach($faqs as $index => $item)
                                    @php
                                        $collapseId = 'collapse' . $index;
                                        $headingId = 'heading' . $index;
                                    @endphp
                                    <div class="accordion-item wow fadeInUp">
                                        <h2 class="accordion-header" id="{{ $headingId }}">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#{{ $collapseId }}"
                                                    aria-expanded="false"
                                                    aria-controls="{{ $collapseId }}">
                                                {{ $item['question'] ?? '' }}
                                            </button>
                                        </h2>
                                        <div id="{{ $collapseId }}" class="accordion-collapse collapse" role="region" aria-labelledby="{{ $headingId }}" data-bs-parent="#accordion">
                                            <div class="accordion-body">
                                                <p>{!! $item['answer'] ?? '' !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>



@endsection

@push('scripts')
{{-- Inputmask for phone numbers --}}
<script src="{{ asset('landing/jquery.inputmask.min.js') }}"></script>
<script>
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
</script>

{{-- Gratitude Slider Initialization --}}
@isset($category->reviews)
    @if(!empty($category->reviews))
        <link rel="stylesheet" href="{{ asset('landing/slick.css') }}">
        <script src="{{ asset('landing/slick.min.js') }}"></script>
        <script>
            $(document).ready(function () {
                // Инициализация слайдера отзывов
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
            });
        </script>
    @endif
@endisset

@isset($category->gallery_images)
    @if(!empty($category->gallery_images))
        <script src="{{ asset('landing/jquery.fancybox.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('[data-fancybox="gallery"]').fancybox({
                    loop: true,
                    buttons: [
                        'zoom',
                        'share',
                        'slideShow',
                        'fullScreen',
                        'download',
                        'thumbs',
                        'close'
                    ]
                });
            });
        </script>
    @endif
@endisset

@if($category->calculator_enabled && !empty($category->calculator_fields))
<script>
    // Calculator configuration from server
    const calculatorConfig = {
        formula: '{{ $category->calculator_formula ?? "" }}',
        currency: '{{ $category->calculator_currency ?? "BYN" }}',
        fields: @json($category->calculator_fields ?? [])
    };

    // Get all calculator input elements
    function getCalculatorInputs() {
        return document.querySelectorAll('.calculator-input');
    }

    // Calculate the result based on formula and input values
    function calculateResult() {
        const inputs = getCalculatorInputs();
        const values = {};

        // Collect all field values
        inputs.forEach(input => {
            const fieldKey = input.dataset.fieldKey || input.name;
            let value;

            if (input.type === 'checkbox') {
                value = input.checked ? 1 : 0;
            } else if (input.type === 'radio') {
                if (input.checked) {
                    value = parseFloat(input.value) || 0;
                } else {
                    return; // Skip unchecked radio buttons
                }
            } else {
                value = parseFloat(input.value) || 0;
            }

            values[fieldKey] = value;
        });

        // Replace formula placeholders with actual values
        let formula = calculatorConfig.formula || '';

        // If no formula, calculate as sum of all field values multiplied
        if (!formula && Object.keys(values).length > 0) {
            // Default: multiply all values
            formula = Object.keys(values).map(key => `{${key}}`).join(' * ');
        }

        // Replace placeholders with values
        Object.keys(values).forEach(key => {
            const placeholder = `{${key}}`;
            formula = formula.replace(new RegExp(placeholder, 'g'), values[key]);
        });

        // Calculate the result using JavaScript eval (for simple math expressions)
        let result = 0;
        try {
            // Sanitize: only allow numbers, operators, parentheses, and spaces
            const sanitizedFormula = formula.replace(/[^0-9+\-*/().\s]/g, '');
            if (sanitizedFormula) {
                result = Function('"use strict";return (' + sanitizedFormula + ')')();
            }
        } catch (e) {
            console.error('Calculation error:', e);
            result = 0;
        }

        // Format and display result
        const totalElement = document.getElementById('calculator-total');
        if (totalElement) {
            totalElement.textContent = result.toLocaleString('ru-RU', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 2
            });
        }

        return result;
    }

    // Reset calculator to default values
    function resetCalculator() {
        const inputs = getCalculatorInputs();

        inputs.forEach((input, index) => {
            const fieldConfig = calculatorConfig.fields[index];

            if (input.type === 'checkbox') {
                input.checked = fieldConfig?.default_value ? true : false;
            } else if (input.type === 'radio') {
                // Reset to first option
                const firstRadio = document.querySelector(`input[name="${input.name}"]`);
                if (firstRadio) firstRadio.checked = true;
            } else if (input.tagName === 'SELECT') {
                const firstOption = input.querySelector('option:not([value=""])');
                if (firstOption) firstOption.selected = true;
            } else {
                input.value = fieldConfig?.default_value || '';
            }

            // Update range display if applicable
            if (input.type === 'range') {
                const display = input.parentElement.querySelector('.range-value');
                if (display) {
                    display.textContent = input.value;
                }
            }
        });

        calculateResult();
    }

    // Initialize calculator on page load
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = getCalculatorInputs();

        // Add event listeners to all inputs
        inputs.forEach(input => {
            // For range sliders, update display value
            if (input.type === 'range') {
                input.addEventListener('input', function() {
                    const display = this.parentElement.querySelector('.range-value');
                    if (display) {
                        display.textContent = this.value;
                    }
                    calculateResult();
                });
            }

            // Add change/input listeners for real-time calculation
            input.addEventListener('change', calculateResult);
            if (input.type !== 'range') {
                input.addEventListener('input', calculateResult);
            }
        });

        // Initial calculation
        calculateResult();
    });
</script>
@endif
@endpush
