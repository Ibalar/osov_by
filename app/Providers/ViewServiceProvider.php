<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ServiceCategory;
use App\Models\SiteSetting;
use App\Support\Breadcrumbs;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        /**
         * Данные ТОЛЬКО для header
         */
        View::composer('partials.header', function ($view) {
            $view->with(
                'serviceCategories',
                ServiceCategory::query()
                    ->where('is_active', true)
                    ->with(['subcategories' => function ($q) {
                        $q->where('is_active', true)
                            ->orderBy('sort_order');
                    }])
                    ->orderBy('sort_order')
                    ->get()
            );

            $view->with('siteSettings', SiteSetting::getInstance());
        });

        /**
         * Данные ТОЛЬКО для footer
         */
        View::composer('partials.footer', function ($view) {
            $view->with('siteSettings', SiteSetting::getInstance());
        });

        /**
         * Глобальные данные для всех страниц
         */
        View::composer('*', function ($view) {

            $seoTitle = $view->getData()['seoTitle'] ?? null;

            $view->with([
                'pageTitle'   => $seoTitle,
                'breadcrumbs' => Breadcrumbs::generate(),
            ]);
        });
    }
}
