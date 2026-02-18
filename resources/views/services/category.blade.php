@extends('layouts.app')

@section('content')

    {{-- Hero Section --}}
    @if($category->hero_title || !empty($category->hero_items))
    <div class="hero__section">
        <div class="header-body">
            <div class="header-body__img"@if($category->hero_bg_image_url) style="background-image: url('{{ asset('storage/' . $category->hero_bg_image) }}'); border-radius: 20px;"@endif></div>
            <div class="container header-body__box">
                <div class="row">
                    <div class="col-lg-6 p-md-0">
                        <h1 class="title header-body__title">
                            {{ $category->hero_title ?? $category->title }}
                        </h1>
                        @if($category->hero_subtitle)
                        <h3 class="header-body__subtitle">
                            {!! $category->hero_subtitle !!}
                        </h3>
                        @endif
                        @if(!empty($category->hero_items))
                        <div class="header-body__container">
                            @foreach($category->hero_items_with_icons as $item)
                            <div class="header-body__item{{ isset($item['icon_url']) && $item['icon_url'] ? ' header-body__item--has-icon' : '' }}">
                                @if(isset($item['icon_url']) && $item['icon_url'])
                                <img src="{{ asset('storage/' .$item['icon']) }}" alt="" class="header-body__icon">
                                @endif
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

                                        <div class="form-block__number">
                                            <div class="form-block__count">
                                                <span>1</span>
                                            </div>
                                            <div class="form-block-text">
                                                <p>Оставьте свой номер телефона</p>
                                            </div>
                                        </div>

                                        <div class="form-block__input">
                                            <input class="mask-phone zphone required" name="phone" type="tel" placeholder="Номер телефона +375...">
                                        </div>
                                        <br>
                                        <div class="form-block__button">
                                            <button type="submit" class="button animat-2 feedback">Отправить заявку</button>
                                        </div>

                                        <div class="form-block__number mt-4">
                                            <div class="form-block__count">
                                                <span>2</span>
                                            </div>
                                            <div class="form-block-text">
                                                <p><span>Наш специалист свяжется с Вами в течение 30 минут</span>, задаст уточняющие вопросы и озвучит стоимость</p>
                                            </div>
                                        </div>

                                        <div class="form-block__number mt-4">
                                            <div class="form-block__count">
                                                <span>3</span>
                                            </div>
                                            <div class="form-block-text">
                                                <p><span>Если цена Вас устроит</span>, к Вам приедет инженер для замера и более предметного разговора и составления конечной сметы. <span class="form-block-text__ital">Выезд бесплатный.</span></p>
                                            </div>
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
                                        @php
                                            $unit = $type['unit'] ?? '';
                                            $map = [
                                                'value 1' => 'м²',
                                                'value 2' => 'м³',
                                                'value 3' => 'м.пог',
                                                'value 4' => 'шт.',
                                            ];
                                            $unit = $map[$unit] ?? $unit;
                                        @endphp
                                        <li><span><img src="{{ asset('images/icon-apartments-amenity-2.svg') }}" alt="Цена от">Стоимость</span>от {!! $type['price'] ?? '' !!} BYN/{{ $unit ?? '' }}</li>
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

    <div class="page-single-post">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    @if(!empty($category->description))
                        <div class="post-content">
                            <div class="post-entry">
                                {!! $category->description !!}
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



                </div>
            </div>
        </div>
    </div>


    <!-- Universal Calculator Section -->
    @if($category->calculator_enabled && !empty($category->calculator_fields))
        <section id="calculator" class="calculator">
            <div class="container">
                <h2 class="title one">
                    {{ $category->calculator_title ?? 'Калькулятор стоимости услуг' }}
                </h2>
                @if($category->calculator_description)
                    <div class="calculator-description mb-4">
                        {!! $category->calculator_description !!}
                    </div>
                @endif

                <div class="calculator__container">
                    <div class="form">
                        <form id="universal-calculator" class="calculator-form">
                            <div class="row">
                                <div class="col-lg-6 col-xl-5 p-lg-0">
                                    @foreach($category->calculator_fields as $fieldIndex => $field)
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

                                        <div class="form__type">
                                            <p class="form__title">{{ $field['label'] ?? '' }}</p>

                                            @if($fieldType === 'radio')
                                                <div class="form-checked">
                                                    @foreach($options as $optionIndex => $option)
                                                        @php
                                                            $optionKey = $fieldKey . '_' . $optionIndex;
                                                            $optionValue = $option['value'] ?? '';
                                                            $optionLabel = $option['label'] ?? '';
                                                        @endphp
                                                        <div class="form-checked__item">
                                                            <input class="calculator-input"
                                                                   type="radio"
                                                                   name="{{ $fieldKey }}"
                                                                   id="{{ $optionKey }}"
                                                                   value="{{ $optionValue }}"
                                                                   data-field-key="{{ $fieldKey }}"
                                                                {{ $loop->first ? 'checked' : '' }}>
                                                            <label for="{{ $optionKey }}">{{ $optionLabel }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @elseif($fieldType === 'select')
                                                <div class="form-block__select">
                                                    <select class="calculator-input"
                                                            id="calc-field-{{ $fieldIndex }}"
                                                            name="{{ $fieldKey }}"
                                                            data-field-key="{{ $fieldKey }}">
                                                        <option value="">Выберите...</option>
                                                        @foreach($options as $optionIndex => $option)
                                                            <option value="{{ $option['value'] ?? '' }}" {{ $loop->first ? 'selected' : '' }}>
                                                                {{ $option['label'] ?? '' }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @elseif($fieldType === 'checkbox')
                                                <div class="form-block__checkbox">
                                                    <label class="check">
                                                        <input class="check__input calculator-input"
                                                               type="checkbox"
                                                               id="calc-field-{{ $fieldIndex }}"
                                                               name="{{ $fieldKey }}"
                                                               value="1"
                                                               data-field-key="{{ $fieldKey }}"
                                                            {{ $defaultValue ? 'checked' : '' }}>
                                                        <span class="check__box"></span>
                                                    </label>
                                                    <p>{{ $field['checkbox_label'] ?? $field['label'] ?? '' }}</p>
                                                </div>
                                            @elseif($fieldType === 'range')
                                                <div class="range-slider range-slider__modal">
                                                    <p class="rangelb">
                                                                        <span class="rangeValues">
                                                                            <span class="range__text">Значение:</span>
                                                                            <span class="range__val">
                                                                                <span class="range-value">{{ $defaultValue }}</span>
                                                                                {{ $field['unit'] ?? '' }}
                                                                            </span>
                                                                        </span>
                                                    </p>
                                                    <div class="range-slider-ip-wrap">
                                                        <input type="range"
                                                               class="calculator-input ip-range"
                                                               id="calc-field-{{ $fieldIndex }}"
                                                               name="{{ $fieldKey }}"
                                                               data-field-key="{{ $fieldKey }}"
                                                               min="{{ $min }}"
                                                               max="{{ $max }}"
                                                               step="{{ $step }}"
                                                               value="{{ $defaultValue }}">
                                                        <span class="tracking-holder"></span>
                                                    </div>
                                                    <div class="range-slider__value">
                                                        <span class="range-slider__item">{{ $min }} {{ $field['unit'] ?? '' }}</span>
                                                        <span class="range-slider__item">> {{ $max }} {{ $field['unit'] ?? '' }}</span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="form-block__input">
                                                    <input type="{{ $fieldType }}"
                                                           class="calculator-input"
                                                           id="calc-field-{{ $fieldIndex }}"
                                                           name="{{ $fieldKey }}"
                                                           data-field-key="{{ $fieldKey }}"
                                                           placeholder="{{ $placeholder }}"
                                                           value="{{ $defaultValue }}"
                                                           @if($min !== '') min="{{ $min }}" @endif
                                                           @if($max !== '') max="{{ $max }}" @endif
                                                           @if($step !== '') step="{{ $step }}" @endif>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>

                                <div class="col-lg-6 col-xl-7 pl-lg-5 pr-lg-0">
                                    <div class="form__box">
                                        <div class="form-total">
                                            <div class="form-total__container">
                                                <div class="form-total__approximate">
                                                    <p class="form-total__param">Расчет выполняется по введенным параметрам</p>
                                                    <span>{{ $category->calculator_result_label ?? 'Итоговая стоимость' }} <sup>*</sup></span>
                                                </div>
                                                <p class="form-total__count">
                                                    <span id="calculator-total">0</span>
                                                    <span class="currency">{{ $category->calculator_currency ?? 'BYN' }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form__box">
                                        <div class="form__button">
                                            <button type="button" class="button animat-1" onclick="calculateResult()">
                                                Рассчитать
                                            </button>
                                        </div>
                                        <div class="form__button">
                                            <button type="button" class="button animat-2" onclick="resetCalculator()">
                                                Сбросить
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form__box">
                                        <p>Стоимость ориентировочная. Точная сумма определяется после выезда специалиста, проведения полных замеров и изысканий.</p>
                                    </div>


                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @endif


    {{-- Gallery Section --}}
    @if(!empty($category->gallery_images))

        <div class="page-gallery bg-section">
            <div class="container">
                <h2 class="title one">{{ $category->gallery_title ?? 'Галерея' }}</h2>
                <!-- gallery section start -->
                <div class="row gallery-items page-gallery-box">
                    @foreach($category->gallery_images_urls ?? [] as $image)
                    <div class="col-lg-4 col-6">
                        <!-- Image Gallery start -->
                        <div class="photo-gallery wow fadeInUp" data-wow-delay="{{ ($loop->index * 0.2) }}s">
                            <a href="{{ $image }}" data-cursor-text="Смотреть">
                                <figure class="image-anime">
                                    <img src="{{ $image }}" alt="Галерея">
                                </figure>
                            </a>
                        </div>
                        <!-- Image Gallery end -->
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
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
        <div class="page-single-post">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
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
                    </div>
                </div>
            </div>
        </div>
    @endif



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

    function getFieldConfig(fieldKey) {
        const matchedField = calculatorConfig.fields.find(field => field?.key === fieldKey);
        if (matchedField) {
            return matchedField;
        }

        if (fieldKey && fieldKey.startsWith('field_')) {
            const index = parseInt(fieldKey.replace('field_', ''), 10);
            return calculatorConfig.fields[index];
        }

        return null;
    }

    function getRangeDisplay(input) {
        const slider = input.closest('.range-slider') || input.parentElement;
        return slider ? slider.querySelector('.range-value') : null;
    }

    // Reset calculator to default values
    function resetCalculator() {
        const inputs = getCalculatorInputs();

        inputs.forEach(input => {
            const fieldKey = input.dataset.fieldKey || input.name;
            const fieldConfig = getFieldConfig(fieldKey);

            if (input.type === 'checkbox') {
                input.checked = fieldConfig?.default_value ? true : false;
            } else if (input.type === 'radio') {
                const firstRadio = document.querySelector(`input[name="${input.name}"]`);
                if (firstRadio) firstRadio.checked = true;
            } else if (input.tagName === 'SELECT') {
                const firstOption = input.querySelector('option:not([value=""])');
                if (firstOption) firstOption.selected = true;
            } else {
                input.value = fieldConfig?.default_value ?? '';
            }

            if (input.type === 'range') {
                const display = getRangeDisplay(input);
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
                    const display = getRangeDisplay(this);
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
