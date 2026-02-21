@extends('layouts.app')

@section('content')
    <!-- Contact Us Page Start -->
    <div class="page-contact-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    
                    <!-- Contact Info Content Start -->
                    <div class="contact-us-content">
                        @if(!empty($page->content))
                            <div class="post-content mb-4">
                                <div class="post-entry text-white">
                                    {!! $page->content !!}
                                </div>
                            </div>
                        @endif
                        
                        <!-- Contact Info List Start -->
                        <div class="contact-info-list">
                            <!-- Contact Info Item Start -->
                            <div class="contact-info-item">
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-phone-white.svg') }}" alt="Телефон">
                                </div>
                                <div class="contact-info-item-content">
                                    <h3>Телефон</h3>
                                    <p>
                                        <a href="tel:+375333196451">+375 (33) 319-64-51</a>
                                    </p>
                                </div>
                            </div>
                            <!-- Contact Info Item End -->
                            
                            <!-- Contact Info Item Start -->
                            <div class="contact-info-item">
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-mail-white.svg') }}" alt="Email">
                                </div>
                                <div class="contact-info-item-content">
                                    <h3>Email</h3>
                                    <p>
                                        <a href="mailto:info@osov.by">info@osov.by</a>
                                    </p>
                                </div>
                            </div>
                            <!-- Contact Info Item End -->
                            
                            <!-- Contact Info Item Start -->
                            <div class="contact-info-item location-item">
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-location-white.svg') }}" alt="Адрес">
                                </div>
                                <div class="contact-info-item-content">
                                    <h3>Адрес</h3>
                                    <p>г. Минск, ул. Примерная, 123</p>
                                </div>
                            </div>
                            <!-- Contact Info Item End -->
                            
                            <!-- Contact Info Item Start -->
                            <div class="contact-info-item">
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-calendar.svg') }}" alt="Режим работы">
                                </div>
                                <div class="contact-info-item-content">
                                    <h3>Режим работы</h3>
                                    <p>Пн-Пт: 9:00 - 18:00</p>
                                    <p>Сб-Вс: выходной</p>
                                </div>
                            </div>
                            <!-- Contact Info Item End -->
                        </div>
                        <!-- Contact Info List End -->
                        
                        <!-- Contact Us Content Footer Start -->
                        <div class="contact-us-content-footer">
                            <div class="contact-us-content-footer-image">
                                <figure>
                                    <img src="{{ asset('images/contact-us-circle.svg') }}" alt="Contact Us">
                                </figure>
                            </div>
                        </div>
                        <!-- Contact Us Content Footer End -->
                    </div>
                    <!-- Contact Info Content End -->
                    
                </div>
                
                <div class="col-lg-7">
                    
                    <!-- Contact Form Box Start -->
                    <div class="cta-form-box">
                        <div class="cta-form-title">
                            <h3 class="text-anime-style-3" data-cursor="-opaque">Оставить заявку</h3>
                        </div>
                        
                        <form action="{{ route('api.foundation-request.store') }}" method="POST" class="contact-form js-telegram-form">
                            @csrf
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label for="name">Ваше имя *</label>
                                        <input type="text" 
                                               id="name" 
                                               name="name" 
                                               class="form-control required" 
                                               required>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label for="phone">Телефон *</label>
                                        <input type="tel" 
                                               id="phone" 
                                               name="phone" 
                                               class="form-control required" 
                                               required>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label for="comment">Сообщение *</label>
                                        <textarea id="comment" 
                                                  name="comment" 
                                                  class="form-control required" 
                                                  rows="5" 
                                                  required></textarea>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12">
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
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Contact Form Box End -->
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Us Page End -->
    
    <!-- Google Map Section Start -->
    <div class="google-map">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="google-map-iframe">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2350.954!2d27.5674!3d53.9!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNTPCsDU0JzAwLjAiTiAyN8KwMzQnMDIuNiJF!5e0!3m2!1sru!2sby!4v1234567890" 
                            width="100%" 
                            height="650" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Google Map Section End -->
@endsection