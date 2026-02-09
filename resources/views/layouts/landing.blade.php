<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    {{-- SEO Meta Tags --}}
    <title>{{ $seoTitle ?? $pageTitle ?? config('app.name') }}</title>
    
    @if(isset($metaDescription))
    <meta name="description" content="{{ $metaDescription }}">
    @endif
    
    {{-- Фавикон --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon.png') }}">
    
    {{-- Лендинг CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/landing/slick.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/landing/slick-theme.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/landing/style.css') }}">
    
    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Yandex.Metrika counter (позже настроить динамически) --}}
    {{--<script type="text/javascript" >
       (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
       m[i].l=1*new Date();
       for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
       k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
       (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

       ym(103268677, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true
       });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/103268677" style="position:absolute; left:-9999px;" alt="" /></div></noscript>--}}
    
    {{-- Google tag --}}
    {{--<script async src="https://www.googletagmanager.com/gtag/js?id=AW-17095585733"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'AW-17095585733');
    </script>--}}
    
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
    <script src="{{ asset('js/landing/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/landing/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/landing/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('js/landing/slick.min.js') }}"></script>
    <script src="{{ asset('js/landing/fancybox/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('js/landing/main.js') }}"></script>
    
    {{-- Дополнительные скрипты --}}
    @stack('scripts')
</body>
</html>
