<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\PortfolioItem;
use App\Models\PortfolioCategory;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PortfolioController extends Controller
{
    /**
     * Список работ - галерея изображений
     */
    public function index(Request $request)
    {
        $page = Page::query()
            ->where('key', 'portfolio')
            ->first();

        $query = PortfolioItem::query()->with('category');

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $items = $query
            ->orderByDesc('created_at')
            ->get();

        $images = $this->buildImageCollection($items);

        $perPage = 15;
        $currentPage = $request->input('page', 1);
        $paginatedImages = new LengthAwarePaginator(
            $images->forPage($currentPage, $perPage),
            $images->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        $categories = PortfolioCategory::query()->orderBy('title')->get();

        return view('portfolio.index', [
            'page' => $page,
            'items' => $items,
            'images' => $paginatedImages,
            'categories' => $categories,

            // Page header
            'pageTitle' => $page?->seo?->h1 ?? $page?->title ?? 'Портфолио',
            'breadcrumbs' => [
                ['title' => 'Главная', 'url' => route('home')],
                ['title' => 'Портфолио'],
            ],

            // SEO
            'seoTitle' => $page?->seo?->title ?? $page?->seo_title ?? 'Портфолио',
            'seoDescription' => $page?->seo?->description ?? $page?->seo_description,
            'seoKeywords' => $page?->seo?->keywords ?? $page?->seo_keywords,
        ]);
    }

    /**
     * Страница работы - галерея изображений одной работы
     */
    public function show(PortfolioItem $item)
    {
        $images = collect($item->gallery_images ?? []);

        $perPage = 15;
        $currentPage = request()->input('page', 1);
        $paginatedImages = new LengthAwarePaginator(
            $images->forPage($currentPage, $perPage),
            $images->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url()]
        );

        $itemTitle = $item->seo?->h1 ?? $item->title;

        return view('portfolio.show', [
            'item' => $item,
            'images' => $paginatedImages,

            // Page header
            'pageTitle' => $itemTitle,
            'breadcrumbs' => [
                ['title' => 'Главная', 'url' => route('home')],
                ['title' => 'Портфолио', 'url' => route('portfolio.index')],
                ['title' => $itemTitle],
            ],

            // SEO
            'seoTitle' => $item->seo?->title ?? $item->seo_title ?? $item->title,
            'seoDescription' => $item->seo?->description ?? $item->seo_description,
            'seoKeywords' => $item->seo?->keywords ?? $item->seo_keywords,
        ]);
    }

    /**
     * Построить плоскую коллекцию изображений из элементов портфолио
     */
    private function buildImageCollection($items): \Illuminate\Support\Collection
    {
        $images = collect();

        foreach ($items as $item) {
            $itemImages = $item->gallery_images ?? [];
            foreach ($itemImages as $imageUrl) {
                $images->push([
                    'url' => $imageUrl,
                    'title' => $item->title,
                    'item_id' => $item->id,
                    'category' => $item->category?->title,
                ]);
            }
        }

        return $images;
    }
}
