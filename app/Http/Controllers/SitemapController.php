<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\Page;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceSubcategory;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\PortfolioItem;
use App\Models\PortfolioCategory;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $services = Service::where('is_active', true)
            ->orderBy('updated_at', 'desc')
            ->get(['slug', 'updated_at']);

        $serviceCategories = ServiceCategory::where('is_active', true)
            ->orderBy('updated_at', 'desc')
            ->get(['slug', 'updated_at']);

        $serviceSubcategories = ServiceSubcategory::where('is_active', true)
            ->orderBy('updated_at', 'desc')
            ->get(['slug', 'updated_at']);

        $projects = Project::where('is_active', true)
            ->orderBy('updated_at', 'desc')
            ->get(['slug', 'updated_at']);

        $projectCategories = ProjectCategory::where('is_active', true)
            ->orderBy('updated_at', 'desc')
            ->get(['slug', 'updated_at']);

        $portfolioItems = PortfolioItem::where('is_active', true)
            ->orderBy('updated_at', 'desc')
            ->get(['slug', 'updated_at']);

        $portfolioCategories = PortfolioCategory::where('is_active', true)
            ->orderBy('updated_at', 'desc')
            ->get(['slug', 'updated_at']);

        return response()->view('sitemap', [
            'services' => $services,
            'serviceCategories' => $serviceCategories,
            'serviceSubcategories' => $serviceSubcategories,
            'projects' => $projects,
            'projectCategories' => $projectCategories,
            'portfolioItems' => $portfolioItems,
            'portfolioCategories' => $portfolioCategories,
        ])->header('Content-Type', 'text/xml');
    }
}