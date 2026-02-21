<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO Meta Tags --}}
    <title>{{ $seoTitle ?? $pageTitle ?? config('app.name') }}</title>

    @if(isset($metaDescription))
    <meta name="description" content="{{ $metaDescription }}">
    @endif

    {{-- Фавикон --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon.png') }}">

    {{-- Лендинг CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/slick.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/slick-theme.css') }}"/>


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

    <link rel="stylesheet" href="{{ asset('landing/style.css') }}">

    @stack('styles')
</head>
<body>
    {{-- Стандартный Header --}}
    @include('partials.header')

    {{-- Контент лендинга --}}
    @yield('content')

    {{-- Стандартный Footer --}}
    @include('partials.footer')

    {{-- Лендинг JS --}}
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('landing/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('landing/slick.min.js') }}"></script>
    <script src="{{ asset('landing/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('landing/main.js') }}"></script>
    <script src="{{ asset('js/telegram-form.js') }}"></script>





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

    {{-- Дополнительные скрипты --}}
    @stack('scripts')
</body>
</html>
