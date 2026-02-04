@php
    $breadcrumbs ??= [];
@endphp

@if(!Route::is('home') && (!empty($pageTitle) || !empty($breadcrumbs)))
    <div class="page-header dark-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        @if(!empty($pageTitle))
                            <h1 class="text-anime-style-3" data-cursor="-opaque">{{ $pageTitle }}</h1>
                        @endif

                        @if(!empty($breadcrumbs))
                            <nav class="wow fadeInUp">
                                <ol class="breadcrumb">
                                    @foreach($breadcrumbs as $crumb)
                                        @if(!empty($crumb['url']))
                                            <li class="breadcrumb-item">
                                                <a href="{{ $crumb['url'] }}">{{ $crumb['title'] }}</a>
                                            </li>
                                        @else
                                            <li class="breadcrumb-item active" aria-current="page">
                                                {{ $crumb['title'] }}
                                            </li>
                                        @endif
                                    @endforeach
                                </ol>
                            </nav>
                        @endif
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
@endif
