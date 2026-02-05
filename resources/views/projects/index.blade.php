@extends('layouts.app')

@section('content')
    <div class="projects-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if($categories->isNotEmpty())
                        <div class="portfolio-filter wow fadeInUp">
                            <a href="{{ route('projects.index') }}" class="{{ !isset($currentCategory) ? 'active' : '' }}">
                                Все проекты
                            </a>
                            @foreach($categories as $cat)
                                <a href="{{ route('projects.category', $cat->slug) }}"
                                   class="{{ isset($currentCategory) && $currentCategory->id == $cat->id ? 'active' : '' }}">
                                    {{ $cat->title }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <div class="row mt-4">
                @forelse($projects as $project)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="project-item wow fadeInUp">
                            <div class="project-image">
                                <a href="{{ route('projects.show', $project->slug) }}">
                                    <img src="{{ $project->cover_image_url }}" alt="{{ $project->title }}" class="img-fluid">
                                </a>
                            </div>
                            <div class="project-content">
                                <h3>
                                    <a href="{{ route('projects.show', $project->slug) }}">
                                        {{ $project->title }}
                                    </a>
                                </h3>
                                <div class="project-meta">
                                    <span>{{ $project->area }} м²</span>
                                    <span>{{ $project->formatted_price }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p>Проекты не найдены.</p>
                    </div>
                @endforelse
            </div>

            <div class="row">
                <div class="col-12">
                    {{ $projects->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
