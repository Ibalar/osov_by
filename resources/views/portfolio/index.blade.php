@extends('layouts.app')

@section('content')
    <!-- Portfolio Gallery Section Start -->
    <div class="our-amenities-prime bg-section">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title section-title-center">
                        <span class="section-sub-title wow fadeInUp fs-6">Наши работы</span>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Портфолио выполненных проектов</h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <!-- Categories Filter Start -->
            @if($categories->isNotEmpty())
                <div class="row mb-5">
                    <div class="col-lg-12">
                        <div class="portfolio-filter wow fadeInUp">
                            <a href="{{ route('portfolio.index') }}" class="{{ !request()->has('category') ? 'active' : '' }}">
                                Все работы
                            </a>
                            @foreach($categories as $category)
                                <a href="{{ route('portfolio.index', ['category' => $category->slug]) }}"
                                   class="{{ request('category') == $category->slug ? 'active' : '' }}">
                                    {{ $category->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            <!-- Categories Filter End -->

            <!-- Gallery Grid Start -->
            @if($images->isNotEmpty())
                <div class="gallery-items row wow fadeInUp">
                    @foreach($images as $image)
                        @if(is_array($image))
                            <div class="col-xl-4 col-md-6 mb-4">
                                <a href="{{ $image['url'] }}" class="portfolio-item photo-gallery">
                                    <figure class="reveal">
                                        <img src="{{ $image['url'] }}"
                                             alt="{{ $image['title'] }}"
                                             loading="lazy">
                                        @if(!empty($image['title']))
                                            <div class="portfolio-item-info">
                                                <h3>{{ $image['title'] }}</h3>
                                                @if(!empty($image['category']))
                                                    <span>{{ $image['category'] }}</span>
                                                @endif
                                            </div>
                                        @endif
                                    </figure>
                                </a>
                            </div>
                        @else
                            <div class="col-xl-4 col-md-6 mb-4">
                                <a href="{{ $image }}" class="portfolio-item photo-gallery">
                                    <figure class="reveal">
                                        <img src="{{ $image }}"
                                             alt="Portfolio image"
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
                            <p class="wow fadeInUp">Изображения портфолио пока не добавлены.</p>
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
                            {{ $images->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            @endif
            <!-- Pagination End -->
        </div>
    </div>
    <!-- Portfolio Gallery Section End -->
@endsection
