<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Project;
use App\Models\ProjectCategory;

class ProjectController extends Controller
{
    /**
     * Страница /projects
     * Каталог проектов + описание
     */
    public function index(Request $request)
    {
        $page = Page::query()
            ->where('key', 'projects')
            ->first();

        $query = Project::query()
            ->where('is_active', true)
            ->with('category');

        /**
         * Фильтрация
         */
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('price_from')) {
            $query->where('price', '>=', (int) $request->price_from);
        }

        if ($request->filled('price_to')) {
            $query->where('price', '<=', (int) $request->price_to);
        }

        if ($request->filled('area_from')) {
            $query->where('area', '>=', (int) $request->area_from);
        }

        if ($request->filled('area_to')) {
            $query->where('area', '<=', (int) $request->area_to);
        }

        $projects = $query
            ->orderByDesc('created_at')
            ->paginate(12)
            ->withQueryString();

        $categories = ProjectCategory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('projects.index', [
            'page' => $page,
            'projects' => $projects,
            'categories' => $categories,

            // SEO
            'seoTitle' => $page?->seo_title ?? 'Проекты домов',
            'seoDescription' => $page?->seo_description,
            'seoKeywords' => $page?->seo_keywords,
        ]);
    }

    /**
     * Страница проекта
     * /projects/{project}
     */
    public function show(Project $project)
    {
        abort_unless($project->is_active, 404);

        $relatedProjects = Project::query()
            ->where('is_active', true)
            ->where('project_category_id', $project->project_category_id)
            ->where('id', '!=', $project->id)
            ->limit(4)
            ->get();

        return view('projects.show', [
            'project' => $project,
            'relatedProjects' => $relatedProjects,

            // SEO
            'seoTitle' => $project->seo_title ?? $project->title,
            'seoDescription' => $project->seo_description,
            'seoKeywords' => $project->seo_keywords,
        ]);
    }
}
