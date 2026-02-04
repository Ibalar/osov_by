<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1">

    @php
        $seoTitle = $seoTitle ?? null;
        $seoDescription = $seoDescription ?? null;
        $seoKeywords = $seoKeywords ?? null;
    @endphp

    {{-- SEO --}}
    <title>
        {{ $seoTitle ?? config('app.name') }}
    </title>

    <meta name="description"
          content="{{ $seoDescription ?? '' }}">

    <meta name="keywords"
          content="{{ $seoKeywords ?? '' }}">

    <meta name="author" content="WebArt.by">

    {{-- Open Graph --}}
    <meta property="og:title"
          content="{{ $seoTitle ?? config('app.name') }}">

    <meta property="og:description"
          content="{{ $seoDescription ?? '' }}">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">

    {{-- Favicon --}}
    <link rel="shortcut icon"
          type="image/x-icon"
          href="{{ asset('images/favicon.png') }}">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&display=swap"
          rel="stylesheet">

    {{-- CSS --}}
    <link href="{{ asset('css/bootstrap.min.css') }}"
          rel="stylesheet">

    <link href="{{ asset('css/slicknav.min.css') }}"
          rel="stylesheet">

    <link href="{{ asset('css/swiper-bundle.min.css') }}"
          rel="stylesheet">

    <link href="{{ asset('css/all.min.css') }}"
          rel="stylesheet">

    <link href="{{ asset('css/animate.css') }}"
          rel="stylesheet">

    <link href="{{ asset('css/magnific-popup.css') }}"
          rel="stylesheet">

    <link href="{{ asset('css/mousecursor.css') }}"
          rel="stylesheet">

    <link href="{{ asset('css/custom.css') }}"
          rel="stylesheet">

    {{-- Дополнительные стили со страниц --}}
    @stack('styles')
</head>

<body>

{{-- Preloader Start --}}
<div class="preloader">
    <div class="loading-container">
        <div class="loading"></div>
        <div id="loading-icon"><img src="{{ asset('images/loader.svg') }}" alt="Идет загрузка..."></div>
    </div>
</div>
{{-- Preloader End --}}

{{-- Header --}}
@include('partials.header')

@include('partials.page-header')




{{-- Main content --}}

    @yield('content')


{{-- Footer --}}
@include('partials.footer')

{{-- JS --}}
<script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>

<script src="{{ asset('js/bootstrap.min.js') }}"></script>

<script src="{{ asset('js/validator.min.js') }}"></script>

<script src="{{ asset('js/jquery.slicknav.js') }}"></script>

<script src="{{ asset('js/swiper-bundle.min.js') }}"></script>

<script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('js/jquery.counterup.min.js') }}"></script>

<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>

<script src="{{ asset('js/SmoothScroll.js') }}"></script>

<script src="{{ asset('js/parallaxie.js') }}"></script>

<script src="{{ asset('js/gsap.min.js') }}"></script>
<script src="{{ asset('js/magiccursor.js') }}"></script>

<script src="{{ asset('js/SplitText.min.js') }}"></script>
<script src="{{ asset('js/ScrollTrigger.min.js') }}"></script>

<script src="{{ asset('js/jquery.mb.YTPlayer.min.js') }}"></script>

<script src="{{ asset('js/wow.min.js') }}"></script>

{{-- Main --}}
<script src="{{ asset('js/function.js') }}"></script>

{{-- Скрипты конкретных страниц --}}
@stack('scripts')


@stack('scripts')

</body>
</html>
