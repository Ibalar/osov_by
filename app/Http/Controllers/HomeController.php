<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Service;
use App\Models\Project;

class HomeController extends Controller
{
    public function __invoke()
    {
        /**
         * Главная страница (SEO + hero + описание)
         */
        $page = Page::query()
            ->where('key', 'home')
            ->first();

        /**
         * Популярные услуги
         */
        $popularServices = Service::query()
            ->where('is_popular', true)
            ->with([
                'category.projectCategory',
                'subcategory'
            ])
            ->orderBy('sort_order')
            ->limit(6)
            ->get();

        /**
         * Готовые проекты (для главной)
         */
        $projects = Project::query()
            ->where('show_on_home', true)
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();

        return view('pages.home', [
            'page' => $page,

            // SEO
            'seoTitle' => $page?->seo_title ?? config('app.name'),
            'seoDescription' => $page?->seo_description,
            'seoKeywords' => $page?->seo_keywords,

            // Content
            'popularServices' => $popularServices,
            'projects' => $projects,
        ]);
    }
}
