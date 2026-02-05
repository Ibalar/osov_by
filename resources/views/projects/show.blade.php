@extends('layouts.app')

@section('content')
    <!-- Project Details Section Start -->
    <div class="page-single-post">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <!-- Project Title & Info -->
                    <div class="project-header mb-4">
                        <h1 class="text-anime-style-3" data-cursor="-opaque">
                            {{ $project->title }}
                        </h1>

                        @if($project->category)
                            <div class="project-category">
                                <a href="{{ route('projects.category', $project->category->slug) }}">
                                    {{ $project->category->title }}
                                </a>
                            </div>
                        @endif

                        <!-- Project Features -->
                        <div class="project-features-list">
                            @if($project->area)
                                <div class="feature-item">
                                    <i class="fas fa-expand"></i>
                                    <span>Площадь: <strong>{{ $project->area }} м²</strong></span>
                                </div>
                            @endif

                            @if($project->floors)
                                <div class="feature-item">
                                    <i class="fas fa-layer-group"></i>
                                    <span>Этажей: <strong>{{ $project->floors }}</strong></span>
                                </div>
                            @endif

                            @if($project->rooms)
                                <div class="feature-item">
                                    <i class="fas fa-bed"></i>
                                    <span>Комнат: <strong>{{ $project->rooms }}</strong></span>
                                </div>
                            @endif

                            @if($project->formatted_price)
                                <div class="feature-item">
                                    <i class="fas fa-tag"></i>
                                    <span>Цена: <strong>{{ $project->formatted_price }}</strong></span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Project Description -->
                    @if($project->description)
                        <div class="project-description mb-4">
                            <div class="post-content">
                                <div class="post-entry">
                                    {!! $project->description !!}
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Gallery Section -->
                    @php
                        $galleryImages = collect($project->gallery_images ?? []);
                        $perPage = 15;
                        $currentPage = request()->input('page', 1);
                        $paginatedImages = new Illuminate\Pagination\LengthAwarePaginator(
                            $galleryImages->forPage($currentPage, $perPage),
                            $galleryImages->count(),
                            $perPage,
                            $currentPage,
                            ['path' => request()->url()]
                        );
                    @endphp

                    @if($paginatedImages->isNotEmpty())
                        <div class="project-gallery mb-4">
                            <h2 class="text-anime-style-3" data-cursor="-opaque">Галерея</h2>

                            <div class="gallery-items row wow fadeInUp">
                                @foreach($paginatedImages as $image)
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <a href="{{ $image }}" class="portfolio-item photo-gallery">
                                            <figure class="reveal">
                                                <img src="{{ $image }}"
                                                     alt="{{ $project->title }}"
                                                     loading="lazy">
                                            </figure>
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Gallery Pagination -->
                            @if($paginatedImages->hasPages())
                                <div class="row mt-4">
                                    <div class="col-lg-12">
                                        <div class="portfolio-pagination wow fadeInUp">
                                            {{ $paginatedImages->links() }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <!-- Related Projects Section Start -->
    @if($relatedProjects->isNotEmpty())
        <div class="our-amenities-prime bg-section">
            <div class="container">
                <div class="row section-row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <span class="section-sub-title wow fadeInUp fs-6">Похожие проекты</span>
                            <h2 class="text-anime-style-3" data-cursor="-opaque">Другие проекты в этой категории</h2>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach($relatedProjects as $related)
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="project-card wow fadeInUp">
                                @if($related->cover_image_url)
                                    <div class="project-image">
                                        <a href="{{ route('projects.show', $related->slug) }}">
                                            <figure class="image-anime">
                                                <img src="{{ $related->cover_image_url }}"
                                                     alt="{{ $related->title }}"
                                                     loading="lazy">
                                            </figure>
                                        </a>
                                    </div>
                                @endif

                                <div class="project-content">
                                    <h3>
                                        <a href="{{ route('projects.show', $related->slug) }}">
                                            {{ $related->title }}
                                        </a>
                                    </h3>

                                    <div class="project-features">
                                        @if($related->area)
                                            <span class="feature">
                                                <i class="fas fa-expand"></i>
                                                {{ $related->area }} м²
                                            </span>
                                        @endif

                                        @if($related->rooms)
                                            <span class="feature">
                                                <i class="fas fa-bed"></i>
                                                {{ $related->rooms }}
                                            </span>
                                        @endif
                                    </div>

                                    @if($related->formatted_price)
                                        <div class="project-price">
                                            {{ $related->formatted_price }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection
