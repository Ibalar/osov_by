@extends('layouts.app')

@section('content')

    <div class="page-gallery">
        <div class="container">

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

            @if($images->isNotEmpty())
                <div class="row gallery-items page-gallery-box">
                    @foreach($images as $image)
                        @if(is_array($image))
                            <div class="col-lg-4 col-6">
                                <div class="photo-gallery wow fadeInUp" data-wow-delay="0.2s">
                                    <a href="{{ $image['url'] }}" data-cursor-text="Смотреть">
                                        <figure class="image-anime">
                                            <img src="{{ $image['url'] }}"
                                                 alt="{{ $image['title'] }}"
                                                 loading="lazy">
                                        </figure>
                                    </a>
                                </div>

                            </div>
                        @else
                            <div class="col-lg-4 col-6">
                                <div class="photo-gallery wow fadeInUp" data-wow-delay="0.2s">
                                    <a href="{{ $image }}" data-cursor-text="Смотреть">
                                        <figure class="image-anime">
                                            <img src="{{ $image }}"
                                                 alt="Portfolio image"
                                                 loading="lazy">
                                        </figure>
                                    </a>
                                </div>

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


@endsection
