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
                                    <img src="{{ asset('images/about-us-image-1-prime.jpg') }}" alt="О компании OSOV">
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
                        <span class="section-sub-title wow fadeInUp fs-5">Наша история</span>
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
                        <span class="section-sub-title wow fadeInUp fs-6">Наши достижения</span>
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
                            <h2><span class="counter">500</span>+</h2>
                            <p class="fs-4">Проектов выполнено</p>
                        </div>

                        <div class="about-us-counter-item">
                            <div class="icon-box mb-3">
                                <img src="{{ asset('images/icon-about-us-item-2-prime.svg') }}" alt="">
                            </div>
                            <h2><span class="counter">98</span>%</h2>
                            <p class="fs-4">Довольных клиентов</p>
                        </div>

                        <div class="about-us-counter-item">
                            <div class="icon-box mb-3">
                                <img src="{{ asset('images/icon-about-us-item-1-prime.svg') }}" alt="">
                            </div>
                            <h2><span class="counter">50</span>+</h2>
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
                <!-- Image Box -->
                <div class="why-choose-image-box">
                    <div class="why-choose-image">
                        <figure>
                            <img src="{{ asset('images/about-us-image-2-prime.jpg') }}" alt="Наши преимущества">
                        </figure>
                    </div>

                    <div class="working-hour-box">
                        <h3>График работы</h3>
                        <ul>
                            <li><span>Пн - Пт</span><span>8:00 - 18:00</span></li>
                            <li><span>Суббота</span><span>9:00 - 15:00</span></li>
                            <li><span>Воскресенье</span><span>Выходной</span></li>
                        </ul>
                    </div>
                </div>

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
                            <img src="{{ asset('images/amenity-image-1.jpg') }}" alt="">
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
                            <img src="{{ asset('images/amenity-image-1-prime.png') }}" alt="">
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

    <!-- Our Values Section Start -->
    <div class="our-amenities">
        <div class="container">
            <div class="row section-row">
                <div class="col-xl-12">
                    <div class="section-title section-title-center">
                        <span class="section-sub-title wow fadeInUp">Наш подход</span>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Ценности компании</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="amenity-item active">
                        <div class="amenity-item-image">
                            <figure>
                                <img src="{{ asset('images/amenity-image-1.jpg') }}" alt="">
                            </figure>
                        </div>
                        <div class="amenity-item-content-box">
                            <div class="amenity-item-header">
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-amenity-feature-item-1.svg') }}" alt="">
                                </div>
                            </div>
                            <div class="amenity-item-content">
                                <h2>Качество</h2>
                                <p>Используем только проверенные материалы и современные технологии строительства.</p>
                            </div>
                            <div class="amenity-item-btn">
                                <a href="{{ route('services.index') }}" class="readmore-btn">Подробнее</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="amenity-item">
                        <div class="amenity-item-image">
                            <figure>
                                <img src="{{ asset('images/amenity-image-1-prime.png') }}" alt="">
                            </figure>
                        </div>
                        <div class="amenity-item-content-box">
                            <div class="amenity-item-header">
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-amenity-feature-item-2.svg') }}" alt="">
                                </div>
                            </div>
                            <div class="amenity-item-content">
                                <h2>Надежность</h2>
                                <p>Гарантируем выполнение всех обязательств. Наша репутация — наш главный актив.</p>
                            </div>
                            <div class="amenity-item-btn">
                                <a href="{{ route('portfolio.index') }}" class="readmore-btn">Портфолио</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="amenity-item">
                        <div class="amenity-item-image">
                            <figure>
                                <img src="{{ asset('images/amenity-image-3-prime.png') }}" alt="">
                            </figure>
                        </div>
                        <div class="amenity-item-content-box">
                            <div class="amenity-item-header">
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-amenity-feature-item-3.svg') }}" alt="">
                                </div>
                            </div>
                            <div class="amenity-item-content">
                                <h2>Прозрачность</h2>
                                <p>Четкая смета, поэтапная оплата и регулярные отчеты о ходе строительства.</p>
                            </div>
                            <div class="amenity-item-btn">
                                <a href="{{ route('page.show', 'contacts') }}" class="readmore-btn">Контакты</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Our Values Section End -->

    <!-- Intro Video Section Start -->
    <div class="intro-video">
        <div class="container">
            <div class="intro-video-box">
                <div class="intro-video-image">
                    <figure>
                        <img src="{{ asset('images/amenity-entry-video-image.jpg') }}" alt="О нашей компании">
                    </figure>
                </div>
                <div class="play-video-circle">
                    <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" data-bs-toggle="modal" data-bs-target="#videoModal">
                        <h2><i class="fas fa-play"></i></h2>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Intro Video Section End -->

    <!-- Video Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body p-0">
                    <div class="ratio ratio-16x9">
                        <iframe id="videoIframe" src="" title="Video" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section Start -->
    <div class="cta-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="cta-box-content">
                        <div class="cta-client-box">
                            <div class="cta-client-images">
                                <div class="satisfy-client-images">
                                    <div class="satisfy-client-image">
                                        <figure><img src="{{ asset('images/author-1.jpg') }}" alt=""></figure>
                                    </div>
                                    <div class="satisfy-client-image">
                                        <figure><img src="{{ asset('images/author-2.jpg') }}" alt=""></figure>
                                    </div>
                                    <div class="satisfy-client-image">
                                        <figure><img src="{{ asset('images/author-3.jpg') }}" alt=""></figure>
                                    </div>
                                    <div class="satisfy-client-image add-more">
                                        <h3>+500</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="cta-client-box-content">
                                <h3>Более 500 довольных клиентов</h3>
                                <p>Доверьте строительство своего дома профессионалам с проверенной репутацией.</p>
                            </div>
                        </div>

                        <div class="section-footer-text section-footer-contact">
                            <span>
                                <img src="{{ asset('images/icon-phone-white.svg') }}" alt="">
                            </span>
                            <ul>
                                <li><a href="tel:+375333196451">+375 (33) 319-64-51</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="cta-form-box">
                        <div class="cta-form-title">
                            <h3 class="text-anime-style-3" data-cursor="-opaque">Обсудить проект</h3>
                        </div>

                        <form action="{{ route('api.foundation-request.store') }}" method="POST" class="contact-form js-telegram-form">
                            @csrf
                            <input type="hidden" name="source_type" value="about">
                            <input type="hidden" name="source_title" value="Страница О нас">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label for="cta-name">Ваше имя *</label>
                                        <input type="text" id="cta-name" name="name" class="form-control required" required>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label for="cta-phone">Телефон *</label>
                                        <input type="tel" id="cta-phone" name="phone" class="form-control required mask-phone" placeholder="+375 (__) ___-__-__" required>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label for="cta-comment">Комментарий</label>
                                        <textarea id="cta-comment" name="comment" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <button type="submit" class="btn-default btn-highlighted w-100">
                                        Отправить заявку
                                    </button>

                                    <p class="form-note mt-3">
                                        Нажимая кнопку, вы соглашаетесь с
                                        <a href="{{ route('page.show', 'privacy') }}" class="text-decoration-underline">политикой конфиденциальности</a>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CTA Section End -->

    <!-- Section Footer Text Start -->
    <div class="section-footer-text">
        <p>
            <span>Есть вопросы?</span>
            Свяжитесь с нами по телефону <a href="tel:+375333196451">+375 (33) 319-64-51</a> или
            <a href="{{ route('page.show', 'contacts') }}">оставьте заявку</a>
        </p>
    </div>
    <!-- Section Footer Text End -->
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

        // Counter animation
        if (typeof $.fn.counterUp !== 'undefined') {
            $('.counter').counterUp({
                delay: 10,
                time: 2000
            });
        }
    });
</script>
@endpush