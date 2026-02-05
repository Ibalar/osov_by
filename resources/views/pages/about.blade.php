@extends('layouts.app')

@section('content')
    
    <!-- About Hero Section Start -->
    <div class="about-us">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h2 class="text-anime-style-3" data-cursor="-opaque">
                            {{ $page->title ?? 'О нас' }}
                        </h2>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-content wow fadeInUp">
                        @if(!empty($page->content))
                            <div class="post-content">
                                <div class="post-entry">
                                    {!! $page->content !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About Us Section End -->
    
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
                        <!-- Counter Item Start -->
                        <div class="about-us-counter-item">
                            <h2><span class="counter">8</span>+</h2>
                            <p class="fs-4">Лет опыта</p>
                        </div>
                        <!-- Counter Item End -->
                        
                        <!-- Counter Item Start -->
                        <div class="about-us-counter-item">
                            <h2><span class="counter">500</span>+</h2>
                            <p class="fs-4">Проектов выполнено</p>
                        </div>
                        <!-- Counter Item End -->
                        
                        <!-- Counter Item Start -->
                        <div class="about-us-counter-item">
                            <h2><span class="counter">98</span>%</h2>
                            <p class="fs-4">Довольных клиентов</p>
                        </div>
                        <!-- Counter Item End -->
                        
                        <!-- Counter Item Start -->
                        <div class="about-us-counter-item">
                            <h2><span class="counter">50</span>+</h2>
                            <p class="fs-4">Квалифицированных специалистов</p>
                        </div>
                        <!-- Counter Item End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Stats Section End -->
    
    <!-- CTA Section Start -->
    <div class="about-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cta-section text-center">
                        <h2 class="text-anime-style-3 mb-4" data-cursor="-opaque">
                            Хотите обсудить ваш проект?
                        </h2>
                        <p class="mb-4">Оставьте заявку, и наш специалист свяжется с вами в ближайшее время</p>
                        <div class="cta-buttons">
                            <a href="{{ route('page.show', 'contacts') }}" class="btn-default btn-highlighted">
                                Связаться с нами
                            </a>
                            <a href="{{ route('projects.index') }}" class="btn-default">
                                Смотреть проекты
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CTA Section End -->
@endsection
