@extends('layouts.app')

@section('content')
    <!-- Project Grid Section Start -->
    <div class="our-amenities-prime bg-section">
        <div class="container">

            <!-- Filters Section -->
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="filter-section">
                        <!-- Category Filter -->
                        <div class="filter-group">
                            <label>Категория:</label>
                            <a href="{{ route('projects.index') }}"
                               class="{{ !request()->has('category') ? 'active' : '' }}">
                                Все
                            </a>
                            @foreach($categories as $cat)
                                <a href="{{ route('projects.index', array_merge(request()->query(), ['category' => $cat->slug])) }}"
                                   class="{{ request('category') == $cat->slug ? 'active' : '' }}">
                                    {{ $cat->title }}
                                </a>
                            @endforeach
                        </div>

                        <!-- Price Filter -->
                        <div class="filter-group">
                            <label>Цена (BYN):</label>
                            <form action="{{ route('projects.index') }}" method="GET" class="filter-form">
                                <input type="number" name="price_from"
                                       placeholder="От"
                                       value="{{ request('price_from') }}"
                                       min="0">
                                <input type="number" name="price_to"
                                       placeholder="До"
                                       value="{{ request('price_to') }}"
                                       min="0">
                                <button type="submit" class="btn-default btn-highlighted">Фильтр</button>
                                <a href="{{ route('projects.index') }}" class="btn-reset">Сбросить</a>
                            </form>
                        </div>

                        <!-- Area Filter -->
                        <div class="filter-group">
                            <label>Площадь (м²):</label>
                            <form action="{{ route('projects.index') }}" method="GET" class="filter-form">
                                <input type="number" name="area_from"
                                       placeholder="От"
                                       value="{{ request('area_from') }}"
                                       min="0">
                                <input type="number" name="area_to"
                                       placeholder="До"
                                       value="{{ request('area_to') }}"
                                       min="0">
                                <button type="submit" class="btn-default btn-highlighted">Фильтр</button>
                                <a href="{{ route('projects.index') }}" class="btn-reset">Сбросить</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Projects Grid -->
            @if($projects->isNotEmpty())
                <div class="row">
                    @foreach($projects as $project)
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="project-card wow fadeInUp">
                                @if($project->cover_image_url)
                                    <div class="project-image">
                                        <a href="{{ route('projects.show', $project->slug) }}">
                                            <figure class="image-anime">
                                                <img src="{{ $project->cover_image_url }}"
                                                     alt="{{ $project->title }}"
                                                     loading="lazy">
                                            </figure>
                                        </a>
                                    </div>
                                @endif

                                <div class="project-content">
                                    <h3>
                                        <a href="{{ route('projects.show', $project->slug) }}">
                                            {{ $project->title }}
                                        </a>
                                    </h3>

                                    @if($project->category)
                                        <div class="project-category">
                                            {{ $project->category->title }}
                                        </div>
                                    @endif

                                    <div class="project-features">
                                        @if($project->area)
                                            <span class="feature">
                                                <i class="fas fa-expand"></i>
                                                {{ $project->area }} м²
                                            </span>
                                        @endif

                                        @if($project->floors)
                                            <span class="feature">
                                                <i class="fas fa-layer-group"></i>
                                                {{ $project->floors }} {{ $project->floors == 1 ? 'этаж' : 'этажей' }}
                                            </span>
                                        @endif

                                        @if($project->rooms)
                                            <span class="feature">
                                                <i class="fas fa-bed"></i>
                                                {{ $project->rooms }} {{ $project->rooms == 1 ? 'комната' : 'комнат' }}
                                            </span>
                                        @endif
                                    </div>

                                    @if($project->formatted_price)
                                        <div class="project-price">
                                            {{ $project->formatted_price }}
                                        </div>
                                    @endif

                                    <div class="project-footer">
                                        <a href="{{ route('projects.show', $project->slug) }}"
                                           class="btn-default btn-highlighted">
                                            Подробнее
                                        </a>
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
                            <p class="wow fadeInUp">Проекты пока не добавлены.</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Pagination -->
            @if($projects->hasPages())
                <div class="row mt-5">
                    <div class="col-lg-12">
                        <div class="portfolio-pagination wow fadeInUp">
                            {{ $projects->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
