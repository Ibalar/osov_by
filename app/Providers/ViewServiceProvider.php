<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ServiceCategory;

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
         * Данные для header
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
        });
    }
}
