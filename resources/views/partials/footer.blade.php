<footer class="main-footer-prime bg-section dark-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Footer Contact List Start -->
                <div class="footer-contact-list-prime">
                    <!-- Footer Contact Item Start -->
                    <div class="footer-contact-item-prime">
                        <div class="icon-box">
                            <img src="{{ asset('images/icon-mail-white.svg') }}" alt="">
                        </div>
                        <div class="footer-contact-item-content-prime">
                            <h3>Email</h3>
                            <p><a href="mailto:{{ $siteSettings->email }}">{{ $siteSettings->email }}</a></p>
                        </div>
                    </div>
                    <!-- Footer Contact Item End -->

                    <!-- Footer Contact Item Start -->
                    <div class="footer-contact-item-prime">
                        <div class="icon-box">
                            <img src="{{ asset('images/icon-phone-white.svg') }}" alt="">
                        </div>
                        <div class="footer-contact-item-content-prime">
                            <h3>Телефон</h3>
                            <p><a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSettings->phone) }}">{{ $siteSettings->phone }}</a></p>
                        </div>
                    </div>
                    <!-- Footer Contact Item End -->

                    <!-- Footer Contact Item Start -->
                    <div class="footer-contact-item-prime">
                        <div class="icon-box">
                            <img src="{{ asset('images/icon-location-white.svg') }}" alt="">
                        </div>
                        <div class="footer-contact-item-content-prime">
                            <h3>Адрес</h3>
                            <p>{{ $siteSettings->address }}</p>
                        </div>
                    </div>
                    <!-- Footer Contact Item End -->
                </div>
                <!-- Footer Contact List End -->
            </div>

            <div class="col-xl-4">
                <!-- About Footer Start -->
                <div class="about-footer-prime">
                    <!-- Footer Logo Start -->
                    <div class="footer-logo-prime">
                        <img src="{{ asset($siteSettings->logo_footer_path) }}" alt="{{ config('app.name') }}">
                    </div>
                    <!-- Footer Logo End -->

                    <!-- About Footer Content Start -->
                    <div class="about-footer-content-prime">
                        <p>Строительство домов под ключ с гарантией результата. Более 8 лет опыта на рынке недвижимости Беларуси. Качественные материалы, профессиональная команда и индивидуальный подход к каждому клиенту.</p>
                    </div>
                    <!-- About Footer Content End -->

                    <!-- Footer Social Links Start -->
                    <div class="footer-social-links-prime">
                        <h3>Мы в социальных сетях:</h3>
                        <ul>
                            @if(!empty($siteSettings->social_links['facebook']))
                                <li><a href="{{ $siteSettings->social_links['facebook'] }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-facebook-f"></i></a></li>
                            @endif
                            @if(!empty($siteSettings->social_links['instagram']))
                                <li><a href="{{ $siteSettings->social_links['instagram'] }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-instagram"></i></a></li>
                            @endif
                            @if(!empty($siteSettings->social_links['linkedin']))
                                <li><a href="{{ $siteSettings->social_links['linkedin'] }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-linkedin-in"></i></a></li>
                            @endif
                            @if(!empty($siteSettings->social_links['youtube']))
                                <li><a href="{{ $siteSettings->social_links['youtube'] }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-youtube"></i></a></li>
                            @endif
                        </ul>
                    </div>
                    <!-- Footer Social Links End -->
                </div>
                <!-- About Footer End -->
            </div>

            <div class="col-xl-8">
                <!-- Footer Links Box Start -->
                <div class="footer-links-box-prime">
                    <!-- Footer Links Start -->
                    <div class="footer-links-prime">
                        <h3>Навигация</h3>
                        <ul>
                            <li><a href="{{ route('home') }}">Главная</a></li>
                            <li><a href="{{ route('services.index') }}">Услуги</a></li>
                            <li><a href="{{ route('projects.index') }}">Проекты</a></li>
                            <li><a href="{{ route('portfolio.index') }}">Портфолио</a></li>
                            <li><a href="{{ route('page.show', 'about') }}">О нас</a></li>
                            <li><a href="{{ route('page.show', 'contacts') }}">Контакты</a></li>
                        </ul>
                    </div>
                    <!-- Footer Links End -->

                    <!-- Footer Links Start -->
                    <div class="footer-links-prime">
                        <h3>Наши услуги</h3>
                        <ul>
                            <li><a href="{{ route('services.index') }}">Строительство домов</a></li>
                            <li><a href="{{ route('services.index') }}">Ремонт и отделка</a></li>
                            <li><a href="{{ route('services.index') }}">Проектирование</a></li>
                            <li><a href="{{ route('services.index') }}">Ландшафтный дизайн</a></li>
                            <li><a href="{{ route('services.index') }}">Инженерные системы</a></li>
                        </ul>
                    </div>
                    <!-- Footer Links End -->

                    <!-- Footer Links Start -->
                    <div class="footer-links-prime footer-newsletter-form-prime">
                        <h3>Подпишитесь на новости</h3>
                        <p>Получайте последние новости о проектах и акциях</p>
                        <form id="newslettersForm" action="#" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="email" name="mail" class="form-control" id="mail" placeholder="Введите ваш email" required="">
                                <button type="submit" class="newsletter-btn-prime"><i class="fa-regular fa-paper-plane"></i></button>
                            </div>
                        </form>
                    </div>
                    <!-- Footer Links End -->
                </div>
                <!-- Footer Links Box End -->
            </div>

            <div class="col-lg-12">
                <!-- Footer Copyright Start -->
                <div class="footer-copyright-prime">
                    <!-- Footer Copyright Text Start -->
                    <div class="footer-copyright-text-prime">
                        <p>Copyright © {{ date('Y') }} Все права защищены.</p>
                    </div>
                    <!-- Footer Copyright Text Start -->

                    <!-- Footer Privacy Policy Start -->
                    <div class="footer-privacy-policy-prime">
                        <ul>
                            <li><a href="{{ route('page.show', 'privacy') }}">Политика конфиденциальности</a></li>
                            <li><a href="{{ route('page.show', 'terms') }}">Условия использования</a></li>
                        </ul>
                    </div>
                    <!-- Footer Privacy Policy End -->
                </div>
                <!-- Footer Copyright End -->
            </div>
        </div>
    </div>
</footer>
