@extends('layouts.app')

@section('content')
    <!-- Hero Section Start -->
    <div class="hero-prime">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <!-- Hero Box Start -->
                    <div class="hero-box-prime">
                        <!-- Hero Content Start -->
                        <div class="hero-content-prime dark-section">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <span class="section-sub-title wow fadeInUp fs-6">Надежность и профессиональный результат</span>
                                <h1 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque">От фундамента до крыши с гарантией результата.</h1>
                                <p class="wow fadeInUp fs-3" data-wow-delay="0.4s">Строим дома под ключ и выполняем отдельные работы, обеспечивая качество на каждом этапе.</p>
                            </div>
                            <!-- Section Title End -->

                            <!-- Hero Content Button Start -->
                            <div class="hero-content-btn-prime wow fadeInUp" data-wow-delay="0.6s">
                                <a href="{{ route('projects.index') }}" class="btn-default btn-highlighted">Каталог проектов</a>
                                <a href="#" class="btn-default btn-light" data-bs-toggle="modal" data-bs-target="#calculationModal">Получить расчет</a>
                            </div>
                            <!-- Hero Content Button End -->

                            <!-- Hero Body Item List Start -->
                            <div class="hero-body-item-list-prime wow fadeInUp" data-wow-delay="0.8s">
                                <!-- Hero Body Item Start -->
                                <div class="hero-body-item-prime">
                                    <div class="icon-box">
                                        <img src="{{ asset('images/icon-hero-body-item-1-prime.svg') }}" alt="">
                                    </div>
                                    <div class="hero-body-item-content-prime">
                                        <h2>Фиксированная цена в договоре</h2>
                                    </div>
                                </div>
                                <!-- Hero Body Item End -->

                                <!-- Hero Body Item Start -->
                                <div class="hero-body-item-prime">
                                    <div class="icon-box">
                                        <img src="{{ asset('images/icon-hero-body-item-2-prime.svg') }}" alt="">
                                    </div>
                                    <div class="hero-body-item-content-prime">
                                        <h2>Подбор участка «под ключ»</h2>
                                    </div>
                                </div>
                                <!-- Hero Body Item End -->

                                <!-- Hero Body Item Start -->
                                <div class="hero-body-item-prime">
                                    <div class="icon-box">
                                        <img src="{{ asset('images/icon-hero-body-item-3-prime.svg') }}" alt="">
                                    </div>
                                    <div class="hero-body-item-content-prime">
                                        <h2>Расширенная гарантия 7 лет</h2>
                                    </div>
                                </div>
                                <!-- Hero Body Item End -->
                            </div>
                            <!-- Hero Body Item List End -->
                        </div>
                        <!-- Hero Content End -->

                        <!-- Hero Image Box Start -->
                        <div class="hero-image-prime">
                            <figure class="image-anime reveal">
                                <img src="{{ asset('images/hero-image-prime.jpg') }}" alt="">
                            </figure>
                        </div>
                        <!-- Hero Image Box End -->
                    </div>
                    <!-- Hero Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Section End -->

    <!-- About US Section Start -->
    <div class="about-us">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title section-title-center">
                        <span class="section-sub-title wow fadeInUp fs-5" style="visibility: visible; animation-name: fadeInUp;">Стройте дом мечты, а не решайте проблемы</span>
                        <h2 class="text-effect" data-cursor="-opaque">Мечтаете о собственном доме, но пугает объем задач, документов и риски? Мы созданы, чтобы взять эту нагрузку на себя.</h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <!-- About Us Counter List Start -->
                    <div class="about-us-counter-list wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <!-- About Us Counter Item Start -->
                        <div class="about-us-counter-item">
                            <h2><span class="counter">8</span>+</h2>
                            <p class="fs-4">Лет опыта</p>
                        </div>
                        <!-- About Us Counter Item End -->

                        <!-- About Us Counter Item Start -->
                        <div class="about-us-counter-item">
                            <h2><span class="counter">500</span>+</h2>
                            <p class="fs-4">Проектов выполнено.</p>
                        </div>
                        <!-- About Us Counter Item End -->

                        <!-- About Us Counter Item Start -->
                        <div class="about-us-counter-item">
                            <h2><span class="counter">98</span>%</h2>
                            <p class="fs-4">Довольных клиентов</p>
                        </div>
                        <!-- About Us Counter Item End -->
                    </div>
                    <!-- About Us Counter List End -->
                </div>
            </div>
        </div>
    </div>
    <!-- About US Section End -->

    <div class="page-blog bg-section">
        <div class="container">
            <div class="row section-row">
                <div class="col-xl-12">
                    <!-- Section Title Start -->
                    <div class="section-title section-title-center">
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Наши услуги</h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>
            <div class="row">
                @foreach($popularCategories as $category)
                <div class="col-xl-4 col-md-6">
                    <div class="post-item wow fadeInUp">
                        <div class="post-featured-image">
                            <a href="{{ route('services.category', $category->slug) }}" data-cursor-text="Подробнее">
                                <figure class="image-anime">
                                    @if($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->title }}">
                                    @else
                                        <img src="{{ asset('images/default-category.jpg') }}" alt="{{ $category->title }}">
                                    @endif
                                </figure>
                            </a>
                        </div>
                        <div class="post-item-body">
                            <div class="post-item-body-content">
                                <div class="post-item-content">
                                    <h2><a href="{{ route('services.category', $category->slug) }}">{{ $category->hero_title }}</a></h2>
                                </div>
                            </div>
                            <div class="post-item-btn">
                                <a href="{{ route('services.category', $category->slug) }}" class="readmore-btn">Подробнее</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Calculation Modal -->
    <div class="modal fade" id="calculationModal" tabindex="-1" role="dialog" aria-labelledby="calculationModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-block b rf">
                        <form action="{{ route('api.foundation-request.store') }}" method="POST" class="form-block__container n form__form callback-form" name="calculation_form">
                            @csrf
                            <fieldset class="form__fields form__hide-success">
                                <h3 class="form-block__title heavy up">
                                    Получить <br> расчет
                                </h3>

                                <div class="form-block__number">
                                    <div class="form-block__count">
                                        <span>1</span>
                                    </div>
                                    <div class="form-block-text">
                                        <p>Оставьте свои контактные данные</p>
                                    </div>
                                </div>

                                <div class="form-block__input">
                                    <input class="mask-name required" name="name" type="text" placeholder="Ваше имя" required>
                                </div>

                                <div class="form-block__input">
                                    <input class="mask-phone zphone required" name="phone" type="tel" placeholder="Номер телефона +375..." required>
                                </div>

                                <div class="form-block__button">
                                    <button type="submit" class="button animat-2 feedback">Получить расчет</button>
                                </div>

                                <div class="form-block__number mt-4">
                                    <div class="form-block__count">
                                        <span>2</span>
                                    </div>
                                    <div class="form-block-text">
                                        <p><span>Наш специалист свяжется с Вами в течение 30 минут</span>, чтобы уточнить детали</p>
                                    </div>
                                </div>

                                <div class="form-block__checkbox">
                                    <label class="check">
                                        <input class="check__input required" type="checkbox" checked required>
                                        <span class="check__box"></span>
                                    </label>
                                    <p>Я согласен(а) с <a href="#">политикой обработки персональных данных</a></p>
                                </div>
                                <input type="hidden" name="source_title" value="Получить расчет (Главная страница)">
                                <input type="hidden" name="source_type" value="home">
                            </fieldset>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="thanksTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-block b">
                        <div class="form-block__container n thanks">
                            <div class="form-block__thenks">✅</div>

                            <h3 class="form-block__title heavy up">Спасибо!</h3>

                            <div class="form-block__number">
                                <div class="form-block-text">
                                    <p>Ваша заявка принята! Ожидайте звонка от нашего менеджера.</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="thanksTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-block b">
                        <div class="form-block__container n thanks">
                            <div class="form-block__thenks">❌</div>

                            <h3 class="form-block__title heavy up">Что-то пошло не так!</h3>

                            <div class="form-block__number">
                                <div class="form-block-text">
                                    <p>Ваша заявка не отправлена! Попробуйте корректно заполнить все необходимые поля формы и повторить попытку.</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        // Обработчик формы в модальном окне
        $('#calculationModal form').on('submit', function(e) {
            e.preventDefault();

            const $form = $(this);
            const $button = $form.find('button[type="submit"]');
            const originalButtonText = $button.text();

            // Валидация
            let isValid = true;
            $form.find('.required').each(function() {
                const $field = $(this);

                if ($field.attr('type') === 'checkbox') {
                    if (!$field.is(':checked')) {
                        isValid = false;
                    }
                    return;
                }

                if (!$field.val() || $field.val() === '0') {
                    isValid = false;
                }
            });

            if (!isValid) {
                alert('Пожалуйста, заполните все обязательные поля.');
                return;
            }

            $button.prop('disabled', true).text('Отправка...');

            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                dataType: 'json',
                success: function(response) {
                    // Закрываем модальное окно формы
                    $('#calculationModal').modal('hide');

                    // Сбрасываем форму
                    $form[0].reset();

                    // Показываем модальное окно успеха
                    if (response.success) {
                        $('#successModal').modal('show');
                    } else {
                        $('#errorModal').modal('show');
                    }
                },
                error: function(xhr) {
                    // Закрываем модальное окно формы
                    $('#calculationModal').modal('hide');

                    // Сбрасываем форму
                    $form[0].reset();

                    // Показываем модальное окно ошибки
                    $('#errorModal').modal('show');
                },
                complete: function() {
                    $button.prop('disabled', false).text(originalButtonText);
                }
            });
        });
    });
    </script>
@endsection
