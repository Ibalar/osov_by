<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Project;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function __invoke()
    {
        /**
         * Главная страница (SEO + hero + описание)
         */
        $page = Cache::remember('home:page', now()->addMinutes(10), function () {
            return Page::query()
                ->where('key', 'home')
                ->first();
        });

        /**
         * Популярные услуги
         */
        $popularServices = Cache::remember('home:popular_services', now()->addMinutes(10), function () {
            return Service::query()
                ->where('is_popular', true)
                ->with([
                    'parentCategory.projectCategory',
                    'subcategory.category.projectCategory',
                ])
                ->orderBy('sort_order')
                ->limit(6)
                ->get();
        });

        /**
         * Популярные категории услуг
         */
        $popularCategories = Cache::remember('home:popular_categories', now()->addMinutes(10), function () {
            return ServiceCategory::query()
                ->active()
                ->popular()
                ->orderBy('sort_order')
                ->limit(6)
                ->get();
        });

        /**
         * Готовые проекты (для главной)
         */
        $projects = Cache::remember('home:projects', now()->addMinutes(10), function () {
            return Project::query()
                ->where('show_on_home', true)
                ->orderByDesc('created_at')
                ->limit(6)
                ->get();
        });

        return view('pages.home', [
            'page' => $page,

            // SEO
            'seoTitle' => $page?->seo_title ?? config('app.name'),
            'seoDescription' => $page?->seo_description,
            'seoKeywords' => $page?->seo_keywords,

            // Content
            'popularServices' => $popularServices,
            'popularCategories' => $popularCategories,
            'projects' => $projects,
        ]);
    }
}
