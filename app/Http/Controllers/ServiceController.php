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
        $page = Page::query()->where('key', 'services')->first();

        $categories = ServiceCategory::query()
            ->where('is_active', true)
            ->with([
                'subcategories' => fn($q) => $q->where('is_active', true)->orderBy('sort_order')
            ])
            ->orderBy('sort_order')
            ->get();

        $breadcrumbs = [
            ['title' => 'Главная', 'url' => route('home')],
            ['title' => 'Услуги', 'url' => ''],
        ];

        return view('services.index', [
            'page' => $page,
            'categories' => $categories,

            // SEO
            'seoTitle' => $page?->seo_title ?? 'Услуги',
            'seoDescription' => $page?->seo_description,
            'seoKeywords' => $page?->seo_keywords,

            // Для page-header
            'pageTitle' => $page?->title ?? 'Услуги',
            'breadcrumbs' => $breadcrumbs,
        ]);
    }


    /**
     * Страница категории услуг
     * /services/{category}
     */
    public function category(ServiceCategory $category)
    {
        abort_unless($category->is_active, 404);

        $category->load([
            'subcategories' => fn ($q) => $q
                ->where('is_active', true)
                ->orderBy('sort_order'),
        ]);

        $services = Service::query()
            ->where(function ($q) use ($category) {
                $q->whereHas('subcategory', fn($q) => $q->where('service_category_id', $category->id))
                    ->orWhere('service_category_id', $category->id);
            })
            ->orderBy('sort_order')
            ->get();

        $breadcrumbs = [
            ['title' => 'Главная', 'url' => route('home')],
            ['title' => 'Услуги', 'url' => route('services.index')],
            ['title' => $category->title],
        ];

        return view('services.category', [
            'category' => $category,
            'services' => $services,

            // SEO
            'seoTitle' => $category->seo_title ?? $category->title,
            'seoDescription' => $category->seo_description,
            'seoKeywords' => $category->seo_keywords,
            'ogImage' => $category->image ? asset('storage/' . $category->image) : asset('images/og-image-default.jpg'),
            'canonicalUrl' => route('services.category', $category->slug),

            // Page header
            'pageTitle' => $category->title,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }



    /**
     * Страница подкатегории
     * /services/{subcategory}
     */
    public function subcategory(ServiceCategory $category, ServiceSubcategory $subcategory)
    {
        abort_unless(
            $subcategory->is_active &&
            $subcategory->service_category_id === $category->id,
            404
        );

        $services = Service::query()
            ->where('service_subcategory_id', $subcategory->id)
            ->orderBy('sort_order')
            ->get();

        return view('services.subcategory', [
            'category' => $category,
            'subcategory' => $subcategory,
            'services' => $services,

            // SEO
            'seoTitle' => $subcategory->seo_title ?? $subcategory->title,
            'seoDescription' => $subcategory->seo_description,
            'seoKeywords' => $subcategory->seo_keywords,
            'ogImage' => $subcategory->image ? asset('storage/' . $subcategory->image) : asset('images/og-image-default.jpg'),
            'canonicalUrl' => route('services.subcategory', [$category->slug, $subcategory->slug]),
        ]);
    }



    /**
     * Страница услуги
     * /services/{service}
     */
    public function show(Service $service)
    {
        $service->load(['subcategory', 'parentCategory']);

        \Log::info('Service requested: ' . $service->slug . ', is_active: ' . ($service->is_active ? 'true' : 'false'));
        abort_unless($service->is_active, 404);

        // Категория
        $categoryLink = $service->category ? route('services.category', $service->category->slug) : '';

        // Подкатегория (требует два параметра: category и subcategory)
        $subcategoryLink = null;
        if ($service->subcategory && $service->category) {
            $subcategoryLink = route('services.subcategory', [
                'category' => $service->category->slug,
                'subcategory' => $service->subcategory->slug
            ]);
        }

        $breadcrumbs = [
            ['title' => 'Главная', 'url' => route('home')],
            ['title' => 'Услуги', 'url' => route('services.index')],
            ['title' => $service->category->title ?? 'Категория', 'url' => $categoryLink],
        ];

        // Добавлять подкатегорию только если она есть
        if ($service->subcategory) {
            $breadcrumbs[] = [
                'title' => $service->subcategory->title,
                'url' => $subcategoryLink ?? ''
            ];
        }

        $breadcrumbs[] = ['title' => $service->title, 'url' => ''];

        return view('services.show', [
            'service' => $service,

            // SEO
            'seoTitle' => $service->seo_title ?? $service->title,
            'seoDescription' => $service->seo_description,
            'seoKeywords' => $service->seo_keywords,
            'ogImage' => asset('images/og-image-default.jpg'),
            'canonicalUrl' => route('services.show', $service->slug),

            // Для page-header
            'pageTitle' => $service->title,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

}
