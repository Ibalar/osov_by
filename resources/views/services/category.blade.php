@extends('layouts.app')

@section('content')

    <div class="page-amenity-single">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="page-single-sidebar">
                        <div class="page-category-list wow fadeInUp">
                            <h2 class="page-category-list-title">Виды услуг</h2>
                            @if($category->subcategories->count())
                                <ul>
                                    @foreach($category->subcategories as $subcategory)
                                        <li>
                                            <a href="{{ route('services.subcategory', [
                                                'category' => $category->slug,
                                                'subcategory' => $subcategory->slug,
                                            ]) }}">
                                                {{ $subcategory->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <div class="sidebar-cta-box wow fadeInUp" data-wow-delay="0.25s">
                            <div class="sidebar-cta-image">
                                <figure>
                                    <img src="{{ asset('images/sidebar-cta-box-image.jpg') }}" alt="">
                                </figure>
                            </div>
                            <div class="sidebar-cta-box-body">
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-sidebar-cta.svg') }}" alt="">
                                </div>
                                <div class="sidebar-cta-box-content">
                                    <h2>Contact Us Today!</h2>
                                    <p>Have questions about our apartments, ongoing projects, or available amenities? Reach out to our dedicated team today</p>
                                    <h3>Call Us At: <a href="tel:+123456789">+(123) 456 - 798</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="amenity-single-content">
                        @if(!empty($category->image))
                            <div class="page-single-image">
                                <figure class="image-anime reveal">
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->title }}">
                                </figure>
                            </div>
                        @endif

                        @if(!empty($category->description))
                            <div class="amenity-entry">
                                {!! $category->description !!}
                            </div>
                        @endif


                        @php
                            $faqs = [];

                            if(!empty($category->faq)) {
                                $faqs = json_decode($category->faq, true) ?: [];
                            } elseif(!empty($subcategory->faq)) {
                                $faqs = json_decode($subcategory->faq, true) ?: [];
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
    </div>

@endsection
