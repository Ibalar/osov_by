@extends('layouts.app')

@section('content')
    <div class="page-single-post">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    
                    <!-- Contact Info -->
                    <div class="contact-info-section">
                        <h2 class="text-anime-style-3 mb-4" data-cursor="-opaque">
                            Контактная информация
                        </h2>
                        
                        @if(!empty($page->content))
                            <div class="post-content mb-4">
                                <div class="post-entry">
                                    {!! $page->content !!}
                                </div>
                            </div>
                        @endif
                        
                        <!-- Contact Details -->
                        <div class="contact-details">
                            <div class="contact-item mb-4">
                                <div class="contact-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="contact-content">
                                    <h4>Телефон</h4>
                                    <p>
                                        <a href="tel:+375333196451">+375 (33) 319-64-51</a>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="contact-item mb-4">
                                <div class="contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="contact-content">
                                    <h4>Email</h4>
                                    <p>
                                        <a href="mailto:info@osov.by">info@osov.by</a>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="contact-item mb-4">
                                <div class="contact-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="contact-content">
                                    <h4>Адрес</h4>
                                    <p>г. Минск, ул. Примерная, 123</p>
                                </div>
                            </div>
                            
                            <div class="contact-item mb-4">
                                <div class="contact-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="contact-content">
                                    <h4>Режим работы</h4>
                                    <p>Пн-Пт: 9:00 - 18:00</p>
                                    <p>Сб-Вс: выходной</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <div class="col-lg-6">
                    
                    <!-- Contact Form -->
                    <div class="contact-form-section">
                        <h2 class="text-anime-style-3 mb-4" data-cursor="-opaque">
                            Оставить заявку
                        </h2>
                        
                        <form action="{{ route('api.foundation-request.store') }}" method="POST" class="contact-form js-telegram-form">
                            @csrf
                            
                            <div class="form-group mb-3">
                                <label for="name">Ваше имя *</label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       class="form-control required" 
                                       required>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="phone">Телефон *</label>
                                <input type="tel" 
                                       id="phone" 
                                       name="phone" 
                                       class="form-control required" 
                                       required>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="comment">Сообщение *</label>
                                <textarea id="comment" 
                                          name="comment" 
                                          class="form-control required" 
                                          rows="5" 
                                          required></textarea>
                            </div>
                            
                            <input type="hidden" name="source_type" value="contact">
                            <input type="hidden" name="source_title" value="Страница контактов">
                            
                            <button type="submit" class="btn-default btn-highlighted w-100">
                                Отправить заявку
                            </button>
                            
                            <p class="form-note mt-3">
                                Нажимая кнопку "Отправить", вы соглашаетесь с 
                                <a href="{{ route('page.show', 'privacy') }}" class="text-decoration-underline">
                                    политикой конфиденциальности
                                </a>
                            </p>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
