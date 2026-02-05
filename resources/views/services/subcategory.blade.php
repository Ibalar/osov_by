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
                        <div class="services-list mb-5">
                            <h2 class="text-anime-style-3 mb-4">Наши услуги:</h2>
                            
                            <div class="row">
                                @foreach($services as $service)
                                    <div class="col-lg-6 mb-4">
                                        <div class="service-item wow fadeInUp">
                                            <div class="service-item-content">
                                                <h3>
                                                    <a href="{{ route('services.show', $service->slug) }}">
                                                        {{ $service->title }}
                                                    </a>
                                                </h3>
                                                
                                                @if($service->excerpt)
                                                    <p>{{ $service->excerpt }}</p>
                                                @endif
                                                
                                                @if($service->formatted_price)
                                                    <div class="service-item-price">
                                                        {{ $service->formatted_price }}
                                                    </div>
                                                @endif
                                                
                                                <div class="service-item-footer">
                                                    <a href="{{ route('services.show', $service->slug) }}" 
                                                       class="btn-default btn-highlighted">
                                                        Подробнее
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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