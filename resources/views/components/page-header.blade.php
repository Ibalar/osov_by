@if(!Route::is('home') && !empty($pageTitle))
    <div class="page-header dark-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="page-header-box">
                        <h1 class="text-anime-style-3" data-cursor="-opaque">
                            {{ $pageTitle }}
                        </h1>

                        @if(!empty($breadcrumbs) && count($breadcrumbs) > 1)
                            <nav class="wow fadeInUp">
                                <ol class="breadcrumb">
                                    @foreach($breadcrumbs as $breadcrumb)
                                        @if(!$loop->last)
                                            <li class="breadcrumb-item">
                                                <a href="{{ $breadcrumb['url'] }}">
                                                    {{ $breadcrumb['title'] }}
                                                </a>
                                            </li>
                                        @else
                                            <li class="breadcrumb-item active"
                                                aria-current="page">
                                                {{ $breadcrumb['title'] }}
                                            </li>
                                        @endif
                                    @endforeach
                                </ol>
                            </nav>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@endif
