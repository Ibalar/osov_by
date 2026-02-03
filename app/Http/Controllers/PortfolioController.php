<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\PortfolioItem;
use App\Models\PortfolioCategory;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Список работ
     */
    public function index(Request $request)
    {
        $page = Page::query()
            ->where('key', 'portfolio')
            ->first();

        $query = PortfolioItem::query()
            ->where('is_active', true)
            ->with('category');

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $items = $query
            ->orderByDesc('created_at')
            ->paginate(12)
            ->withQueryString();

        $categories = PortfolioCategory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('portfolio.index', [
            'page' => $page,
            'items' => $items,
            'categories' => $categories,

            // SEO
            'seoTitle' => $page?->seo_title ?? 'Портфолио',
            'seoDescription' => $page?->seo_description,
            'seoKeywords' => $page?->seo_keywords,
        ]);
    }

    /**
     * Страница работы
     */
    public function show(PortfolioItem $item)
    {
        abort_unless($item->is_active, 404);

        $related = PortfolioItem::query()
            ->where('is_active', true)
            ->where('portfolio_category_id', $item->portfolio_category_id)
            ->where('id', '!=', $item->id)
            ->limit(4)
            ->get();

        return view('portfolio.show', [
            'item' => $item,
            'related' => $related,

            // SEO
            'seoTitle' => $item->seo_title ?? $item->title,
            'seoDescription' => $item->seo_description,
            'seoKeywords' => $item->seo_keywords,
        ]);
    }
}
