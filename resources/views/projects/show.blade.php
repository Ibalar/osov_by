@extends('layouts.app')

@section('content')
    <!-- Section Under Development Placeholder -->
    <div class="our-amenities-prime bg-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <span class="section-sub-title wow fadeInUp fs-6">Информация</span>
                        <h2 class="text-anime-style-3 wow fadeInUp" data-cursor="-opaque">Раздел в разработке</h2>
                        <p class="wow fadeInUp fs-4" data-wow-delay="0.2s">
                            Мы работаем над наполнением этого раздела. Скоро здесь появится подробная информация о проекте.
                        </p>
                        <div class="text-center mt-4">
                            <a href="{{ route('home') }}" class="btn-default btn-highlighted">На главную</a>
                            <a href="{{ route('projects.index') }}" class="btn-default btn-light ml-2">Все проекты</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
