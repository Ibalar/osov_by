@extends('layouts.app')

@section('content')
    <div class="our-amenities-prime bg-section">
        <div class="container">
            
            <!-- Page Description -->
            @if($page?->description)
                <div class="row section-row mb-5">
                    <div class="col-lg-12">
                        <div class="section-title section-title-center">
                            <div class="post-content">
                                <div class="post-entry">
                                    {!! $page->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            
            <!-- Services Categories Grid -->
            @if($categories->isNotEmpty())
                <div class="row">
                    @foreach($categories as $category)
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="service-category-card wow fadeInUp">
                                @if($category->image)
                                    <div class="service-category-image">
                                        <a href="{{ route('services.category', $category->slug) }}">
                                            <figure class="image-anime">
                                                <img src="{{ asset('storage/' . $category->image) }}" 
                                                     alt="{{ $category->title }}"
                                                     loading="lazy">
                                            </figure>
                                        </a>
                                    </div>
                                @endif
                                
                                <div class="service-category-content">
                                    <h3>
                                        <a href="{{ route('services.category', $category->slug) }}">
                                            {{ $category->title }}
                                        </a>
                                    </h3>
                                    
                                    @if($category->description)
                                        <p>{!! Str::limit(strip_tags($category->description), 120) !!}</p>
                                    @endif
                                    
                                    <!-- Subcategories List -->
                                    @if($category->subcategories->isNotEmpty())
                                        <div class="service-subcategories">
                                            <h4>Разделы:</h4>
                                            <ul>
                                                @foreach($category->subcategories as $subcategory)
                                                    <li>
                                                        <a href="{{ route('services.subcategory', ['category' => $category->slug, 'subcategory' => $subcategory->slug]) }}">
                                                            {{ $subcategory->title }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    
                                    <div class="service-category-footer">
                                        <a href="{{ route('services.category', $category->slug) }}" 
                                           class="btn-default btn-highlighted">
                                            Подробнее
                                        </a>
                                        
                                        @if($category->projectCategory)
                                            <a href="{{ route('projects.category', $category->projectCategory->slug) }}" 
                                               class="btn-default">
                                                Проекты
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
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