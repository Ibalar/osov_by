@extends('layouts.app')

@section('content')
    <!-- Service Details Section Start -->
    <div class="page-single-post">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    
                    <!-- Service Header -->
                    <div class="service-header mb-4">
                        <h1 class="text-anime-style-3" data-cursor="-opaque">
                            {{ $service->title }}
                        </h1>
                        
                        @if($service->category)
                            <div class="service-breadcrumbs">
                                <a href="{{ route('services.index') }}">Услуги</a>
                                <span>/</span>
                                
                                @if($service->has_subcategory)
                                    <a href="{{ route('services.category', $service->category->slug) }}">
                                        {{ $service->category->title }}
                                    </a>
                                    <span>/</span>
                                    @if($service->subcategory)
                                        <a href="{{ route('services.subcategory', ['category' => $service->category->slug, 'subcategory' => $service->subcategory->slug]) }}">
                                            {{ $service->subcategory->title }}
                                        </a>
                                    @endif
                                @else
                                    <span>{{ $service->category->title }}</span>
                                @endif
                            </div>
                        @endif
                        
                        @if($service->formatted_price)
                            <div class="service-price">
                                <span class="price-label">Стоимость:</span>
                                <span class="price-value">{{ $service->formatted_price }}</span>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Service Excerpt -->
                    @if($service->excerpt)
                        <div class="service-excerpt mb-4">
                            <p class="lead">{{ $service->excerpt }}</p>
                        </div>
                    @endif
                    
                    <!-- Service Description -->
                    @if($service->description)
                        <div class="service-description mb-4">
                            <div class="post-content">
                                <div class="post-entry">
                                    {!! $service->description !!}
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Service CTA -->
                    <div class="service-cta mb-5">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="cta-box">
                                    <h3>Нужна консультация?</h3>
                                    <p>Оставьте заявку, и наш специалист свяжется с вами для подробного обсуждения вашего проекта.</p>
                                    <a href="{{ route('page.show', 'contacts') }}" class="btn-default btn-highlighted">
                                        Оставить заявку
                                    </a>
                                </div>
                            </div>
                            
                            @if($service->category?->projectCategory)
                                <div class="col-lg-6">
                                    <div class="cta-box">
                                        <h3>Готовые проекты</h3>
                                        <p>Посмотрите наши готовые проекты в этой категории.</p>
                                        <a href="{{ route('projects.category', $service->category->projectCategory->slug) }}" 
                                           class="btn-default">
                                            Смотреть проекты
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection