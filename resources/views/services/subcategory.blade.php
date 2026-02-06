@extends('layouts.app')

@section('content')
    <div class="page-single-post">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Subcategory Image -->
                    @if(!empty($subcategory->image))
                        <div class="post-image mb-4">
                            <figure class="image-anime reveal">
                                <img src="{{ asset('storage/' . $subcategory->image) }}" alt="{{ $subcategory->title }}">
                            </figure>
                        </div>
                    @endif
                    
                    <!-- Subcategory Description -->
                    @if(!empty($subcategory->description))
                        <div class="post-content mb-5">
                            <div class="post-entry">
                                {!! $subcategory->description !!}
                            </div>
                        </div>
                    @endif
                    
                    <!-- Services List -->
                    @if($services->isNotEmpty())
                        <div class="our-amenities-prime bg-section" style="margin-top: 4rem;">
                            <div class="container">
                                <div class="row section-row">
                                    <div class="col-lg-12">
                                        <!-- Section Title Start -->
                                        <div class="section-title">
                                            <span class="section-sub-title wow fadeInUp fs-6">Наши услуги</span>
                                            <h2 class="text-anime-style-3" data-cursor="-opaque">Услуги в подкатегории «{{ $subcategory->title }}»</h2>
                                        </div>
                                        <!-- Section Title End -->
                                    </div>
                                </div>

                                <div class="row">
                                    @foreach($services as $service)
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
                    @else
                        <div class="section-title section-title-center">
                            <p class="wow fadeInUp">Услуги в этой категории пока не добавлены.</p>
                        </div>
                    @endif
                    
                    <!-- FAQ Section -->
                    @php
                        $faqs = [];

                        if(!empty($subcategory->faq)) {
                            $faqs = json_decode($subcategory->faq, true) ?: [];
                        } elseif(!empty($category->faq)) {
                            $faqs = json_decode($category->faq, true) ?: [];
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