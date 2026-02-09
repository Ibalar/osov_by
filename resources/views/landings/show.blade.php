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
                @foreach($landingPage->foundation_types_with_urls ?? [] as $index => $type)
                <div class="col-md-6 col-lg-4 p-md-0 @if($index % 2 == 0 && $index > 0) pl-md-1 pl-lg-0 @else pr-md-1 @endif">
                    <div class="foundations__item">
                        @if(isset($type['image_url']))
                        <div class="foundations__img">
                            <img src="{{ $type['image_url'] }}" alt="{{ $type['title'] ?? '' }}">
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
@endsection
