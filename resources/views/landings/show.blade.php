@extends('layouts.landing')

@section('content')
    {{-- Hero Section --}}
    <header class="header">
        <div class="header-body">
            <div class="header-body__img"></div>
            <div class="container header-body__box">
                <div class="row">
                    <div class="col-lg-6 p-md-0">
                        <h1 class="title header-body__title">
                            {{ $landingPage->hero_title ?? 'Строительство фундаментов' }}
                        </h1>
                        <h3 class="header-body__subtitle">
                            {{ $landingPage->hero_subtitle ?? 'любой сложности без переплат за 15 дней с гарантией' }}
                        </h3>
                        <div class="header-body__container">
                            @foreach($landingPage->hero_items ?? [] as $item)
                            <div class="header-body__item">
                                <p>{!! $item['text'] ?? '' !!}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Форма заявки --}}
                    <div class="col-lg-6 p-0 p-sm-2 p-md-0 pr-lg-0">
                        <div class="offset-xl-3 offset-md-2 offset-lg-0 col-md-8 col-lg-12 col-xl-9 mt-4 mt-lg-0 p-0">
                            <div class="form-block b header-body__form rf">
                                <form action="{{ route('api.foundation-request.store') }}" method="POST" class="form-block__container n form__form callback-form js-telegram-form" name="header_form">
                                    @csrf
                                    <input type="hidden" name="source_type" value="landing">
                                    <input type="hidden" name="source_id" value="{{ $landingPage->id }}">
                                    <input type="hidden" name="source_title" value="{{ $landingPage->title }}">
                                    <fieldset class="form__fields form__hide-success">
                                        <h3 class="form-block__title">Получите <span>точную смету</span> фундамента</h3>

                                        <div class="form-block__number">
                                            <div class="form-block__count">
                                                <span>1</span>
                                            </div>
                                            <div class="form-block-text">
                                                <p>Оставьте свой номер телефона</p>
                                            </div>
                                        </div>

                                        <div class="form-block__select form-group">
                                            <select name="typep" class="required">
                                                <option value="0" class="form-block__disabled">Выберите тип постройки</option>
                                                <option value="Дом">Дом</option>
                                                <option value="Дача">Дача</option>
                                                <option value="Гараж">Гараж</option>
                                                <option value="Теплица">Теплица</option>
                                            </select>
                                        </div>

                                        <div class="form-block__select form-group">
                                            <select name="typef" class="required">
                                                <option value="0" class="form-block__disabled">Выберите тип фундамента</option>
                                                <option value="Не знаю">Не знаю</option>
                                                <option value="Ленточный">Ленточный</option>
                                                <option value="Монолитная плита">Монолитная плита</option>
                                                <option value="Свайно-винтовой">Свайно-винтовой</option>
                                                <option value="УШП">УШП</option>
                                                <option value="УФФ">УФФ</option>
                                                <option value="Свайно-ростверковый">Свайно-ростверковый</option>
                                                <option value="Из блоков ФБС">Из блоков ФБС</option>
                                                <option value="Цокольный этаж">Цокольный этаж</option>
                                                <option value="Столбчатый">Столбчатый</option>
                                            </select>
                                        </div>

                                        <div class="form-block__input">
                                            <div class="row mb-3">
                                                <div class="col-6 pr-2">
                                                    <input class="mask-num required" name="size1" type="text" placeholder="Длина, м">
                                                </div>
                                                <div class="col-6 pl-2">
                                                    <input class="mask-num required" name="size2" type="text" placeholder="Ширина, м">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-block__input">
                                            <input class="mask-phone zphone required" name="phone" type="tel" placeholder="Номер телефона +375...">
                                        </div>
                                        <br>
                                        <div class="form-block__button">
                                            <button type="submit" class="button animat-2 feedback">Получить расчет и смету</button>
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
    </header>

    {{-- Типы фундаментов --}}
    <section id="foundations" class="foundations">
        <div class="container">
            <h2 class="title one">{{ $landingPage->foundations_title ?? 'Какой фундамент необходим?' }}</h2>
            <div class="row justify-content-center">
                @foreach($landingPage->foundation_types ?? [] as $index => $type)
                <div class="col-md-6 col-lg-4 p-md-0 @if($index % 2 == 0 && $index > 0) pl-md-1 pl-lg-0 @else pr-md-1 @endif">
                    <div class="foundations__item">
                        @if(isset($type['image']))
                        <div class="foundations__img">
                            <img src="{{ asset('storage/' . $type['image']) }}" alt="{{ $type['title'] ?? '' }}">
                        </div>
                        @endif
                        <div class="foundations__content">
                            <p class="foundations__title">{!! $type['title'] ?? '' !!}</p>
                            <div class="foundations__price">
                                <span>Цена от</span>
                                <p>{!! $type['price'] ?? '' !!}</p>
                            </div>
                        </div>
                        <div class="foundations__button">
                            <button class="button animat-{{ ($index % 3) + 1 }}" data-toggle="modal" data-target="#foundations1" data-title="Расчет <span>{{ $type['title'] ?? '' }}</span>" data-theme="{{ $type['title'] ?? '' }}">
                                Рассчитать фундамент
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Help Section --}}
    @if($landingPage->help_text)
    <section class="help">
        <div class="container">
            <div class="help__content">
                {!! $landingPage->help_text !!}
            </div>
        </div>
    </section>
    @endif

    {{-- Examples Section --}}
    @if(!empty($landingPage->examples))
    <section id="examples" class="examples">
        <div class="container">
            <h2 class="title one">{{ $landingPage->examples_title ?? 'Выполненные работы' }}</h2>
            <div class="row">
                @foreach($landingPage->examples as $example)
                <div class="col-md-6 col-lg-4 p-md-0 mb-4">
                    <div class="examples__item">
                        @if(isset($example['image']))
                        <div class="examples__img">
                            <img src="{{ asset('storage/landings/' . $landingPage->slug . '/examples/' . $example['image']) }}" alt="{{ $example['title'] ?? '' }}">
                        </div>
                        @endif
                        <div class="examples__content">
                            <h3>{{ $example['title'] ?? '' }}</h3>
                            <p>{{ $example['description'] ?? '' }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Gallery Section --}}
    @if(!empty($landingPage->gallery_images))
    <section id="gallery" class="gallery">
        <div class="container">
            <h2 class="title one">{{ $landingPage->gallery_title ?? 'Портфолио' }}</h2>
            <div class="row">
                @foreach($landingPage->gallery_images_urls ?? [] as $image)
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
    @if(!empty($landingPage->price_table))
    <section id="price" class="price">
        <div class="container">
            <h2 class="title one">{{ $landingPage->price_title ?? 'Цены на фундаменты' }}</h2>
            <div class="price__table">
                <table class="table">
                    <thead>
                        <tr>
                            @if(!empty($landingPage->price_table[0]))
                            @foreach(array_keys($landingPage->price_table[0]) as $header)
                            <th>{{ $header }}</th>
                            @endforeach
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($landingPage->price_table as $row)
                        <tr>
                            @foreach($row as $cell)
                            <td>{!! $cell !!}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    @endif

    {{-- Calculator Section --}}
    @if($landingPage->calculator_text || !empty($landingPage->calculator_types))
    <section id="calculator" class="calculator">
        <div class="container">
            <h2 class="title one">{{ $landingPage->calculator_title ?? 'Калькулятор стоимости фундамента' }}</h2>
            <div class="calculator__content">
                @if($landingPage->calculator_text)
                    {!! $landingPage->calculator_text !!}
                @endif

                @if(!empty($landingPage->calculator_types) && !empty($landingPage->calculator_services))
                <div class="calculator__container">
                    <div class="form">
                        <div class="row">
                            <div class="col-lg-6 col-xl-5 p-lg-0">
                                <div class="form__type">
                                    <p class="form__title">Фундамент:</p>
                                    <div id="checked" class="form-checked">
                                        @foreach($landingPage->calculator_types as $index => $type)
                                        <div class="form-checked__item">
                                            <input value="{{ $type['value'] ?? 0 }}" type="radio" name="check-type" id="calc-type-{{ $index }}" {{ $loop->first ? 'checked' : '' }}>
                                            <label for="calc-type-{{ $index }}">{{ $type['label'] ?? '' }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form__type">
                                    <p class="form__title">Услуга:</p>
                                    <div id="service" class="form-checked service">
                                        @foreach($landingPage->calculator_services as $index => $service)
                                        <div class="form-checked__item">
                                            <input value="{{ $service['value'] ?? 1 }}" type="radio" name="check-service" id="calc-service-{{ $index }}" {{ $loop->first ? 'checked' : '' }}>
                                            <label for="calc-service-{{ $index }}">{{ $service['label'] ?? '' }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-xl-7 pl-lg-5 pr-lg-0">
                                <div class="range-slider range-slider__modal">
                                    <p class="rangelb">
                                        <span class="rangeValues">
                                            <input type="text" class="val2 form-control" value="{{ $landingPage->calculator_range['default'] ?? 12 }}" oninput="getVals(this);">
                                            <span class="range__text">Объём работ:</span>
                                            <span class="range__val">м <sup>3</sup></span>
                                        </span>
                                    </p>
                                    <div class="range-slider-ip-wrap">
                                        <input value="1" min="{{ $landingPage->calculator_range['min'] ?? 0 }}" max="{{ $landingPage->calculator_range['max'] ?? 100 }}" step="{{ $landingPage->calculator_range['step'] ?? 1 }}" type="range" class="val1 ip-range">
                                        <input id="range-slider" value="{{ $landingPage->calculator_range['default'] ?? 12 }}" min="{{ $landingPage->calculator_range['min'] ?? 0 }}" max="{{ $landingPage->calculator_range['max'] ?? 100 }}" step="{{ $landingPage->calculator_range['step'] ?? 1 }}" type="range" class="ip-range">
                                        <span class="tracking-holder"></span>
                                    </div>

                                    <div class="range-slider__value">
                                        <span class="range-slider__item">{{ $landingPage->calculator_range['min'] ?? 0 }} м<sup>3</sup></span>
                                        <span class="range-slider__item"> > {{ $landingPage->calculator_range['max'] ?? 100 }} м<sup>3</sup></span>
                                    </div>
                                </div>

                                <div class="form__box">
                                    <div class="form-total">
                                        <div class="form-total__container">
                                            <div class="form-total__approximate">
                                                <p class="form-total__param">Для расчета используются
                                                    <br>рекомендуемые параметры
                                                </p>
                                                <span>Примерная стоимость <sup>*</sup>
                                                </span>
                                            </div>
                                            <p class="form-total__count"><span id="total">{{ number_format((($landingPage->calculator_types[0]['value'] ?? 350) * ($landingPage->calculator_services[0]['value'] ?? 4) * ($landingPage->calculator_range['default'] ?? 12)), 0, ',', ' ') }} BYN</span></p>
                                        </div>
                                    </div>

                                    <div class="form__button">
                                        <button class="button animat-1" data-toggle="modal" data-target="#master">Вызвать замерщика</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
    @endif

    {{-- Facility Section --}}
    @if($landingPage->facility_text)
    <section class="facility">
        <div class="container">
            <h2 class="title one">{{ $landingPage->facility_title ?? 'Наши преимущества' }}</h2>
            <div class="facility__content">
                {!! $landingPage->facility_text !!}
            </div>
        </div>
    </section>
    @endif

    {{-- Reviews Section --}}
    @if(!empty($landingPage->reviews))
    <section id="gratitude" class="gratitude">
        <div class="container">
            <h2 class="title one">{{ $landingPage->reviews_title ?? 'Отзывы клиентов' }}</h2>
            <div class="gratitude-slider" id="gratitude-slider">
                @foreach($landingPage->reviews as $review)
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

    {{-- FAQ Section --}}
    @if(!empty($landingPage->faq))
    <section id="questions" class="questions">
        <div class="container">
            <h2 class="title one">{{ $landingPage->faq_title ?? 'Часто задаваемые вопросы' }}</h2>
            <div class="faq-accordion" id="accordion">
                @foreach($landingPage->faq as $index => $item)
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
    </section>
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
@endpush
