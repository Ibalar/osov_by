<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show(Page $page)
    {
        abort_unless($page->is_active ?? true, 404);

        $view = view()->exists("pages.{$page->key}") ? "pages.{$page->key}" : "pages.show";

        return view($view, [
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
