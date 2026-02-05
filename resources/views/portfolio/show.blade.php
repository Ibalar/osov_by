@extends('layouts.app')

@section('content')
    <!-- Portfolio Item Gallery Section Start -->
    <div class="our-amenities-prime bg-section">
        <div class="container">
            <!-- Item Title Start -->
            @if($item)
                <div class="row section-row mb-4">
                    <div class="col-lg-12">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <span class="section-sub-title wow fadeInUp fs-6">
                                @if($item->category)
                                    {{ $item->category->title }}
                                @else
                                    Портфолио
                                @endif
                            </span>
                            <h2 class="text-anime-style-3" data-cursor="-opaque">
                                {{ $item->title }}
                            </h2>
                            @if($item->description)
                                <p class="wow fadeInUp">{{ $item->description }}</p>
                            @endif
                        </div>
                        <!-- Section Title End -->
                    </div>
                </div>
            @endif
            <!-- Item Title End -->

            <!-- Gallery Grid Start -->
            @if($images->isNotEmpty())
                <div class="gallery-items row wow fadeInUp">
                    @foreach($images as $image)
                        @if(is_array($image))
                            <div class="col-xl-4 col-md-6 mb-4">
                                <a href="{{ $image['url'] }}" class="portfolio-item photo-gallery">
                                    <figure class="reveal">
                                        <img src="{{ $image['url'] }}"
                                             alt="{{ $image['title'] ?? $item->title }}"
                                             loading="lazy">
                                    </figure>
                                </a>
                            </div>
                        @else
                            <div class="col-xl-4 col-md-6 mb-4">
                                <a href="{{ $image }}" class="portfolio-item photo-gallery">
                                    <figure class="reveal">
                                        <img src="{{ $image }}"
                                             alt="{{ $item->title }}"
                                             loading="lazy">
                                    </figure>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            @else
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title section-title-center">
                            <p class="wow fadeInUp">Изображения для этого проекта пока не добавлены.</p>
                        </div>
                    </div>
                </div>
            @endif
            <!-- Gallery Grid End -->

            <!-- Pagination Start -->
            @if($images->hasPages())
                <div class="row mt-5">
                    <div class="col-lg-12">
                        <div class="portfolio-pagination wow fadeInUp">
                            {{ $images->links() }}
                        </div>
                    </div>
                </div>
            @endif
            <!-- Pagination End -->
        </div>
    </div>
    <!-- Portfolio Item Gallery Section End -->
@endsection
