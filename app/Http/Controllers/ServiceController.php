<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceSubcategory;

class ServiceController extends Controller
{
    /**
     * Страница /services
     * Категории + описание страницы
     */
    public function index()
    {
        $page = Page::query()
            ->where('key', 'services')
            ->first();

        $categories = ServiceCategory::query()
            ->where('is_active', true)
            ->with([
                'subcategories' => function ($q) {
                    $q->where('is_active', true)
                        ->orderBy('sort_order');
                }
            ])
            ->orderBy('sort_order')
            ->get();

        return view('services.index', [
            'page' => $page,
            'categories' => $categories,

            // SEO
            'seoTitle' => $page?->seo_title ?? 'Услуги',
            'seoDescription' => $page?->seo_description,
            'seoKeywords' => $page?->seo_keywords,
        ]);
    }

    /**
     * Страница категории услуг
     * /services/{category}
     */
    public function category(ServiceCategory $category)
    {
        abort_unless($category->is_active, 404);

        $services = Service::query()
            ->whereHas('category', function ($query) use ($category) {
                $query->where('service_categories.id', $category->id)
                ->where('service_categories.is_active', true);
            })
            ->orderBy('sort_order')
            ->get();

        return view('services.category', [
            'category' => $category,
            'services' => $services,

            // SEO
            'seoTitle' => $category->seo_title ?? $category->title,
            'seoDescription' => $category->seo_description,
            'seoKeywords' => $category->seo_keywords,
        ]);
    }

    /**
     * Страница подкатегории
     * /services/{subcategory}
     */
    public function subcategory(ServiceSubcategory $subcategory)
    {
        abort_unless($subcategory->is_active, 404);

        $services = Service::query()
            ->whereHas('subcategory', function ($query) use ($subcategory) {
                $query->where('service_subcategories.id', $subcategory->id) // явно
                ->where('service_subcategories.is_active', true); // если есть
            })
            ->orderBy('sort_order')
            ->get();


        return view('services.subcategory', [
            'subcategory' => $subcategory,
            'services' => $services,

            // SEO
            'seoTitle' => $subcategory->seo_title ?? $subcategory->title,
            'seoDescription' => $subcategory->seo_description,
            'seoKeywords' => $subcategory->seo_keywords,
        ]);
    }

    /**
     * Страница услуги
     * /services/{service}
     */
    public function show(Service $service)
    {
        abort_unless($service->is_active, 404);

        return view('services.show', [
            'service' => $service,

            // SEO
            'seoTitle' => $service->seo_title ?? $service->title,
            'seoDescription' => $service->seo_description,
            'seoKeywords' => $service->seo_keywords,
        ]);
    }
}
