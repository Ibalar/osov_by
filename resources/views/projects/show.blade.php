@extends('layouts.app')

@section('content')
    <div class="project-single">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="project-details">
                        <h1>{{ $project->title }}</h1>
                        <div class="project-description">
                            {!! $project->description !!}
                        </div>
                        
                        @if(!empty($project->gallery_images))
                            <div class="project-gallery mt-4">
                                <div class="row">
                                    @foreach($project->gallery_images as $image)
                                        <div class="col-md-4 mb-3">
                                            <a href="{{ $image }}" class="gallery-item">
                                                <img src="{{ $image }}" class="img-fluid" alt="">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="project-sidebar">
                        <div class="project-info-box">
                            <ul>
                                <li><strong>Площадь:</strong> {{ $project->area }} м²</li>
                                <li><strong>Этажность:</strong> {{ $project->floors }}</li>
                                <li><strong>Комнат:</strong> {{ $project->rooms }}</li>
                                <li><strong>Цена:</strong> {{ $project->formatted_price }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            @if($relatedProjects->isNotEmpty())
                <div class="related-projects mt-5">
                    <h2>Похожие проекты</h2>
                    <div class="row">
                        @foreach($relatedProjects as $related)
                            <div class="col-md-3">
                                <div class="project-item">
                                    <a href="{{ route('projects.show', $related->slug) }}">
                                        <img src="{{ $related->cover_image_url }}" alt="{{ $related->title }}" class="img-fluid">
                                        <h4>{{ $related->title }}</h4>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
