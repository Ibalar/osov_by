<header class="main-header {{ Route::is('home') ? 'main-header-prime' : '' }}">
    <div class="header-sticky">
        <nav class="navbar navbar-expand-lg">
            <div class="container{{ Route::is('home') ? '-fluid' : '' }}">

                {{-- Logo --}}
                @if(Route::is('home'))
                    <p class="navbar-brand">
                        <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}">
                    </p>
                @else
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('images/logo-dark.png') }}" alt="{{ config('app.name') }}">
                    </a>
                @endif

                {{-- Main Menu --}}
                <div class="collapse navbar-collapse main-menu">
                    <div class="nav-menu-wrapper">
                        <ul class="navbar-nav mr-auto" id="menu">

                            {{-- Services --}}
                            <li class="nav-item submenu">
                                <a class="nav-link" href="{{ route('services.index') }}">
                                    Строительство
                                </a>

                                @if(!empty($serviceCategories))
                                    <ul>
                                        @foreach($serviceCategories as $category)
                                            <li class="nav-item {{ $category->subcategories->count() ? 'submenu' : '' }}">
                                                <a class="nav-link"
                                                   href="{{ route('services.category', $category->slug) }}">
                                                    {{ $category->title }}
                                                </a>

                                                @if($category->subcategories->count())
                                                    <ul>
                                                        @foreach($category->subcategories as $subcategory)
                                                            <li class="nav-item">
                                                                <a class="nav-link"
                                                                   href="{{ route('services.subcategory', [
                                       'category' => $category->slug,
                                       'subcategory' => $subcategory->slug,
                                   ]) }}">
                                                                    {{ $subcategory->title }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                            </li>

                            {{-- Projects --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('projects.index') }}">
                                    Проектирование
                                </a>
                            </li>

                            {{-- About --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('page.show', 'about') }}">
                                    О нас
                                </a>
                            </li>

                            {{-- Portfolio --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('portfolio.index') }}">
                                    Портфолио
                                </a>
                            </li>

                            {{-- Contacts --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('page.show', 'contacts') }}">
                                    Контакты
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>

                {{-- Header phone --}}
                <div class="header-btn">
                    <a href="tel:+375333196451" class="btn-default {{ Route::is('home') ? '' : 'btn-highlighted' }}">
                        +375 (33) 319-64-51
                    </a>
                </div>

                <div class="navbar-toggle"></div>
            </div>
        </nav>

        <div class="responsive-menu"></div>
    </div>
</header>
