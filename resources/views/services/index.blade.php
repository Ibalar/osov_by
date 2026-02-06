@extends('layouts.app')

@section('content')

    <div class="page-amenities">
        <div class="container">
            @if($categories->isNotEmpty())
                <div class="row amenity-item-list">
                    @foreach($categories as $category)
                    <div class="col-xl-4 col-md-6">
                        <!-- Amenity Item Start -->
                        <div class="amenity-item {{ $loop->first ? 'active' : '' }} wow fadeInUp">
                            <!-- Amenity Item Image Start -->
                            @if($category->image)
                                <div class="amenity-item-image">
                                    <figure>
                                        <img src="{{ asset('storage/' . $category->image) }}"
                                             alt="{{ $category->title }}"
                                             loading="lazy">
                                    </figure>
                                </div>
                            @endif
                            <!-- Amenity Item Image End -->

                            <!-- Amenity Item Content Box Start -->
                            <div class="amenity-item-content-box">
                                <!-- Amenity Item Header Start -->
                                <div class="amenity-item-header">
                                    <div class="amenity-item-content">
                                        <h2>
                                            <a href="{{ route('services.category', $category->slug) }}">
                                                {{ $category->title }}
                                            </a>
                                        </h2>
                                    </div>
                                </div>
                                <!-- Amenity Item Header End -->

                                <!-- Amenity Item Body Start -->
                                <div class="amenity-item-body">
                                    <!-- Amenity Item Content Start -->
                                    <div class="amenity-item-content">
                                        @if($category->description)
                                            <p>{!! Str::limit(strip_tags($category->description), 120) !!}</p>
                                        @endif
                                    </div>
                                    <!-- Amenity Item Content End -->

                                    <!-- Amenity Item Button Start -->
                                    <div class="amenity-item-btn">
                                        <a href="{{ route('services.category', $category->slug) }}"
                                           class="readmore-btn">
                                            Подробнее
                                        </a>
                                    </div>
                                    <!-- Amenity Item Button End -->
                                </div>
                                <!-- Amenity Item Body End -->
                            </div>
                            <!-- Amenity Item Content Box End -->
                        </div>
                        <!-- Amenity Item End -->
                    </div>
                    @endforeach
                </div>
                @else
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title section-title-center">
                                <p class="wow fadeInUp">Услуги пока не добавлены.</p>
                            </div>
                        </div>
                    </div>
                @endif
        </div>
    </div>
@endsection
