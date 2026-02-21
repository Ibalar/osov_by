@extends('layouts.app')

@section('content')
    <!-- About Hero Section Start -->
    <div class="about-hero-section">
        <div class="hero-prime">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-box-prime">
                            <!-- Hero Content Start -->
                            <div class="hero-content-prime dark-section">
                                <!-- Section Title Start -->
                                <div class="section-title">
                                    <span class="section-sub-title wow fadeInUp fs-6">Надежность и профессионализм</span>
                                    <h1 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque">
                                        {{ $page->title ?? 'О компании OSOV' }}
                                    </h1>
                                    <p class="wow fadeInUp fs-3" data-wow-delay="0.4s">
                                        Строим дома под ключ с гарантией качества. Более 8 лет опыта, 500+ реализованных проектов и тысячи довольных клиентов.
                                    </p>
                                </div>
                                <!-- Section Title End -->

                                <!-- Hero Content Button Start -->
                                <div class="hero-content-btn-prime wow fadeInUp" data-wow-delay="0.6s">
                                    <a href="#about-content" class="btn-default btn-highlighted">Узнать больше</a>
                                    <a href="{{ route('page.show', 'contacts') }}" class="btn-default btn-light">Связаться с нами</a>
                                </div>
                                <!-- Hero Content Button End -->

                                <!-- Hero Body Item List Start -->
                                <div class="hero-body-item-list-prime wow fadeInUp" data-wow-delay="0.8s">
                                    <div class="hero-body-item-prime">
                                        <div class="icon-box">
                                            <img src="{{ asset('images/icon-hero-body-item-1-prime.svg') }}" alt="">
                                        </div>
                                        <div class="hero-body-item-content-prime">
                                            <h2>Фиксированная цена в договоре</h2>
                                        </div>
                                    </div>

                                    <div class="hero-body-item-prime">
                                        <div class="icon-box">
                                            <img src="{{ asset('images/icon-hero-body-item-2-prime.svg') }}" alt="">
                                        </div>
                                        <div class="hero-body-item-content-prime">
                                            <h2>Гарантия 7 лет на все работы</h2>
                                        </div>
                                    </div>

                                    <div class="hero-body-item-prime">
                                        <div class="icon-box">
                                            <img src="{{ asset('images/icon-hero-body-item-3-prime.svg') }}" alt="">
                                        </div>
                                        <div class="hero-body-item-content-prime">
                                            <h2>Прозрачная смета без скрытых платежей</h2>
                                        </div>
                                    </div>
                                </div>
                                <!-- Hero Body Item List End -->
                            </div>
                            <!-- Hero Content End -->

                            <!-- Hero Image Box Start -->
                            <div class="hero-image-prime">
                                <figure class="image-anime reveal">
                                    <img src="{{ asset('images/hero-image-about.jpg') }}" alt="О компании OSOV">
                                </figure>
                            </div>
                            <!-- Hero Image Box End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About Hero Section End -->

    <!-- About Content Section Start -->
    <div id="about-content" class="about-us">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h2 class="text-anime-style-3" data-cursor="-opaque">
                            @if(!empty($page->content))
                                {!! $page->content !!}
                            @else
                                Компания OSOV — это команда профессионалов, которая превращает мечты о собственном доме в реальность. Мы специализируемся на строительстве домов под ключ, выполняя все этапы работ от проектирования до финальной отделки.
                            @endif
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About Content Section End -->

    <!-- Stats Section Start -->
    <div class="our-amenities-prime bg-section">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Цифры говорят за нас</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="about-us-counter-list wow fadeInUp">
                        <div class="about-us-counter-item">
                            <div class="icon-box mb-3">
                                <img src="{{ asset('images/icon-about-counter-1-prime.svg') }}" alt="">
                            </div>
                            <h2><span class="counter">8</span>+</h2>
                            <p class="fs-4">Лет опыта</p>
                        </div>

                        <div class="about-us-counter-item">
                            <div class="icon-box mb-3">
                                <img src="{{ asset('images/icon-about-us-item-1-prime.svg') }}" alt="">
                            </div>
                            <h2><span class="counter">50</span>+</h2>
                            <p class="fs-4">Проектов выполнено</p>
                        </div>

                        <div class="about-us-counter-item">
                            <div class="icon-box mb-3">
                                <img src="{{ asset('images/icon-about-us-item-1-prime.svg') }}" alt="">
                            </div>
                            <h2><span class="counter">10</span>+</h2>
                            <p class="fs-4">Квалифицированных специалистов</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Stats Section End -->

    <!-- Why Choose Us Section Start -->
    <div class="why-choose-us">
        <div class="container">
            <div class="row section-row">
                <div class="col-xl-12">
                    <div class="section-title section-title-center">
                        <span class="section-sub-title wow fadeInUp">Почему выбирают нас</span>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Наши преимущества</h2>
                    </div>
                </div>
            </div>

            <div class="why-choose-us-box">

                <!-- Feature Items -->
                <div class="why-choose-us-item">
                    <div class="why-choose-item-header">
                        <div class="icon-box">
                            <img src="{{ asset('images/icon-amenity-item-1-prime.svg') }}" alt="">
                        </div>
                    </div>
                    <div class="why-choose-item-content">
                        <h3>Фиксированная стоимость</h3>
                        <p>Цена в договоре не меняется. Никаких скрытых платежей и дополнительных расходов.</p>
                    </div>
                    <div class="why-choose-item-body-image">
                        <figure>
                            <img src="{{ asset('images/amenity-image-1-1.png') }}" alt="">
                        </figure>
                    </div>
                </div>

                <div class="why-choose-us-item">
                    <div class="why-choose-item-header">
                        <div class="icon-box">
                            <img src="{{ asset('images/icon-amenity-item-2-prime.svg') }}" alt="">
                        </div>
                    </div>
                    <div class="why-choose-item-content">
                        <h3>Гарантия 7 лет</h3>
                        <p>Расширенная гарантия на все виды работ. Мы отвечаем за качество каждого этапа.</p>
                    </div>
                    <div class="why-choose-item-body-image">
                        <figure>
                            <img src="{{ asset('images/amenity-image-1-2.png') }}" alt="">
                        </figure>
                    </div>
                </div>

                <!-- Counter Boxes -->
                <div class="why-choose-counter-boxes">
                    <div class="why-choose-counter-item highlighted-box">
                        <div class="why-choose-counter-no">
                            <h2><span class="counter">100</span>%</h2>
                        </div>
                        <div class="why-choose-counter-content">
                            <h3>Соблюдение сроков</h3>
                            <p>Строим точно в срок, указанный в договоре</p>
                        </div>
                    </div>

                    <div class="why-choose-counter-item">
                        <div class="why-choose-counter-no">
                            <h2><span class="counter">24</span>ч</h2>
                        </div>
                        <div class="why-choose-counter-content">
                            <h3>Поддержка клиентов</h3>
                            <p>Оперативное решение любых вопросов</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="why-choose-footer">
                <div class="why-choose-footer-list">
                    <ul>
                        <li>Индивидуальный подход</li>
                        <li>Качественные материалы</li>
                        <li>Профессиональная команда</li>
                        <li>Прозрачная документация</li>
                        <li>Поэтапная оплата</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Why Choose Us Section End -->
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Phone input mask
        if (typeof $.fn.inputmask !== 'undefined') {
            $('.mask-phone').inputmask({
                mask: '+375 (99) 999-99-99',
                placeholder: '_',
                showMaskOnHover: false,
                clearIncomplete: true
            });

            $('.mask-phone').on('blur', function() {
                let phone = $(this).val();
                let validCodes = ['25', '29', '33', '44'];
                let enteredCode = phone.substring(6, 8);

                if (phone && !validCodes.includes(enteredCode)) {
                    alert('Введите номер с кодом 25, 29, 33 или 44!');
                    $(this).val('');
                }
            });
        }

        // Video modal
        $('#videoModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var videoUrl = button.attr('href');

            // Convert YouTube URL to embed URL
            var videoId = '';
            if (videoUrl.indexOf('youtube.com') !== -1) {
                videoId = videoUrl.split('v=')[1];
                if (videoId) {
                    var ampersandPosition = videoId.indexOf('&');
                    if (ampersandPosition !== -1) {
                        videoId = videoId.substring(0, ampersandPosition);
                    }
                }
            } else if (videoUrl.indexOf('youtu.be') !== -1) {
                videoId = videoUrl.split('/').pop();
            }

            if (videoId) {
                var embedUrl = 'https://www.youtube.com/embed/' + videoId + '?autoplay=1';
                $(this).find('iframe').attr('src', embedUrl);
            }
        });

        $('#videoModal').on('hide.bs.modal', function() {
            $(this).find('iframe').attr('src', '');
        });

    });
</script>
@endpush
