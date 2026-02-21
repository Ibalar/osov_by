@extends('layouts.app')

@php
    $seoTitle = 'Страница не найдена (404)';
    $seoDescription = 'К сожалению, запрашиваемая страница не существует или была перемещена. Перейдите на главную страницу или свяжитесь с нами.';
    $robots = 'noindex, nofollow';
@endphp

@section('content')
    <!-- 404 Error Section Start -->
    <div class="error-section dark-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="error-box-prime text-center">
                        <!-- 404 Number -->
                        <div class="error-number wow fadeInUp" data-wow-delay="0.1s">
                            <span class="error-code">4</span>
                            <span class="error-zero">
                                <span class="zero-inner">
                                    <i class="fas fa-search"></i>
                                </span>
                            </span>
                            <span class="error-code">4</span>
                        </div>

                        <!-- Error Content -->
                        <div class="error-content-prime">
                            <h1 class="text-anime-style-3 wow fadeInUp" data-cursor="-opaque" data-wow-delay="0.2s">
                                Страница не найдена
                            </h1>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">
                                К сожалению, запрашиваемая вами страница не существует или была перемещена.
                            </p>

                            <!-- Error Actions -->
                            <div class="error-actions wow fadeInUp" data-wow-delay="0.4s">
                                <a href="{{ route('home') }}" class="btn-default btn-highlighted">
                                    <i class="fas fa-home"></i> На главную
                                </a>
                                <a href="{{ route('page.show', 'contacts') }}" class="btn-default btn-light">
                                    <i class="fas fa-envelope"></i> Связаться с нами
                                </a>
                            </div>

                            <!-- Additional Info -->
                            <div class="error-info mt-5 wow fadeInUp" data-wow-delay="0.5s">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="info-item">
                                            <i class="fas fa-sitemap"></i>
                                            <p><a href="{{ route('services.index') }}">Наши услуги</a></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-item">
                                            <i class="fas fa-building"></i>
                                            <p><a href="{{ route('portfolio.index') }}">Портфолио</a></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-item">
                                            <i class="fas fa-info-circle"></i>
                                            <p><a href="{{ route('page.show', 'about') }}">О компании</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 404 Error Section End -->

    @push('styles')
        <style>
            .error-section {
                min-height: 70vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 100px 0;
            }

            .error-box-prime {
                max-width: 800px;
                margin: 0 auto;
            }

            .error-number {
                font-size: 180px;
                font-weight: 900;
                line-height: 1;
                margin-bottom: 40px;
                color: #ffffff;
                position: relative;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .error-number .error-code {
                color: rgba(255, 255, 255, 0.1);
                position: relative;
                z-index: 1;
            }

            .error-number .error-zero {
                width: 160px;
                height: 160px;
                border: 8px solid rgba(255, 255, 255, 0.1);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 20px;
                position: relative;
            }

            .error-number .zero-inner {
                width: 120px;
                height: 120px;
                background: linear-gradient(135deg, var(--theme-color) 0%, var(--theme-color-dark) 100%);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #ffffff;
                font-size: 50px;
            }

            .error-number .zero-inner i {
                animation: search-pulse 2s ease-in-out infinite;
            }

            @keyframes search-pulse {
                0%, 100% {
                    transform: scale(1);
                }
                50% {
                    transform: scale(1.1);
                }
            }

            .error-content-prime h1 {
                font-size: 42px;
                font-weight: 700;
                margin-bottom: 20px;
                color: #ffffff;
            }

            .error-content-prime > p {
                font-size: 18px;
                color: rgba(255, 255, 255, 0.7);
                max-width: 600px;
                margin: 0 auto 40px;
            }

            .error-actions {
                display: flex;
                gap: 20px;
                justify-content: center;
                flex-wrap: wrap;
            }

            .error-actions .btn-default {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                padding: 15px 35px;
            }

            .error-info {
                padding-top: 60px;
                border-top: 1px solid rgba(255, 255, 255, 0.1);
            }

            .info-item {
                padding: 20px;
            }

            .info-item i {
                font-size: 36px;
                color: var(--theme-color);
                margin-bottom: 15px;
                display: block;
            }

            .info-item p {
                font-size: 16px;
                margin: 0;
            }

            .info-item a {
                color: rgba(255, 255, 255, 0.8);
                text-decoration: none;
                transition: color 0.3s ease;
            }

            .info-item a:hover {
                color: var(--theme-color);
            }

            @media (max-width: 768px) {
                .error-number {
                    font-size: 120px;
                }

                .error-number .error-zero {
                    width: 100px;
                    height: 100px;
                    border-width: 6px;
                    margin: 0 10px;
                }

                .error-number .zero-inner {
                    width: 75px;
                    height: 75px;
                    font-size: 35px;
                }

                .error-content-prime h1 {
                    font-size: 32px;
                }

                .error-content-prime > p {
                    font-size: 16px;
                }

                .error-actions {
                    flex-direction: column;
                    align-items: center;
                }

                .error-actions .btn-default {
                    width: 100%;
                    max-width: 300px;
                    justify-content: center;
                }
            }
        </style>
    @endpush
@endsection
