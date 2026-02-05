<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show(Page $page)
    {
        abort_unless($page->is_active ?? true, 404); // is_active может не существовать в таблице

        return view('pages.show', [
            'page' => $page,

            // SEO
            'seoTitle' => $page->seo_title ?? $page->title,
            'seoDescription' => $page->seo_description,
            'seoKeywords' => $page->seo_keywords,

            // Для page-header
            'pageTitle' => $page->title,
            'breadcrumbs' => [
                ['title' => 'Главная', 'url' => route('home')],
                ['title' => $page->title],
            ],
        ]);
    }
}
