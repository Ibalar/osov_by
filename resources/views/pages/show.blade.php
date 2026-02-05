@extends('layouts.app')

@section('content')
    <div class="page-single-post">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    
                    <!-- Page Content -->
                    @if($page)
                        @if(!empty($page->content))
                            <div class="post-content">
                                <div class="post-entry">
                                    {!! $page->content !!}
                                </div>
                            </div>
                        @else
                            <div class="section-title section-title-center">
                                <p>Контент страницы пока не добавлен.</p>
                            </div>
                        @endif
                    @else
                        <div class="section-title section-title-center">
                            <h2>Страница не найдена</h2>
                            <p>Запрошенная страница не существует.</p>
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
@endsection
