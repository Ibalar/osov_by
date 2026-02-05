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
                                <a href="#" class="btn-default btn-light">Получить расчет</a>
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

    <!-- Our Amenities Section Start -->
    <div class="our-amenities-prime bg-section">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title section-title-center">
                        <span class="section-sub-title wow fadeInUp fs-6">Наши услуги</span>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">От мечты до новоселья с уверенностью в результате</h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
                @foreach($popularServices as $service)
                    <div class="col-xl-4 col-md-6">
                        <div class="amenity-item-prime wow fadeInUp">

                            <div class="amenity-item-body-prime">

                                <div class="amenity-item-content-prime">
                                    <h2>
                                        <a href="{{ route('services.show', $service->slug) }}">
                                            {{ $service->title }}
                                        </a>
                                    </h2>
                                    <p>{{ $service->excerpt }}</p>
                                </div>

                                <div class="amenity-item-footer-prime">
                                    <div class="hero-content-btn wow fadeInUp" data-wow-delay="0.4s">
                                        <a href="{{ route('services.show', $service->slug) }}" class="btn-default btn-highlighted">
                                            подробнее
                                        </a>

                                        @if($service->category?->projectCategory)
                                            <a href="{{ route('projects.category', $service->category->projectCategory->slug) }}" class="btn-default">
                                                проекты
                                            </a>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
    <!-- Our Amenities Section End -->
@endsection
