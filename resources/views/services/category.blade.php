@extends('layouts.app')

@section('content')

    <div class="page-single-post">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Post Featured Image Start -->
                    @if(!empty($category->image))
                        <div class="post-image">
                            <figure class="image-anime reveal">
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->title }}">
                            </figure>
                        </div>
                    @endif
                    <!-- Post Featured Image Start -->

                    <!-- Post Single Content Start -->

                    @if(!empty($category->description))
                        <div class="post-content">
                            <div class="post-entry">
                                {!! $category->description !!}
                            </div>
                        </div>
                    @endif

                    @php
                        $faqs = [];

                        if(!empty($category->faq)) {
                            $faqs = json_decode($category->faq, true) ?: [];
                        } elseif(!empty($subcategory->faq)) {
                            $faqs = json_decode($subcategory->faq, true) ?: [];
                        }
                    @endphp

                    @if(!empty($faqs))
                        <div class="page-single-faqs">
                            <div class="section-title">
                                <h2 class="text-anime-style-3" data-cursor="-opaque">Популярные вопросы и ответы</h2>
                            </div>
                            <div class="faq-accordion" id="accordion">
                                @foreach($faqs as $index => $item)
                                    @php
                                        $collapseId = 'collapse' . $index;
                                        $headingId = 'heading' . $index;
                                    @endphp
                                    <div class="accordion-item wow fadeInUp">
                                        <h2 class="accordion-header" id="{{ $headingId }}">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#{{ $collapseId }}"
                                                    aria-expanded="false"
                                                    aria-controls="{{ $collapseId }}">
                                                {{ $item['question'] ?? '' }}
                                            </button>
                                        </h2>
                                        <div id="{{ $collapseId }}" class="accordion-collapse collapse" role="region" aria-labelledby="{{ $headingId }}" data-bs-parent="#accordion">
                                            <div class="accordion-body">
                                                <p>{!! $item['answer'] ?? '' !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>



@endsection
