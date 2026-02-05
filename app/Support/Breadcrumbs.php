<?php

namespace App\Support;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class Breadcrumbs
{
    public static function generate(): array
    {
        $route = Route::current();
        $breadcrumbs = [];

        // Главная всегда первая
        $breadcrumbs[] = [
            'title' => 'Главная',
            'url' => route('home'),
        ];

        if (!$route) {
            return $breadcrumbs;
        }

        $routeName = $route->getName();
        $params = $route->parameters();

        switch ($routeName) {

            case 'services.index':
                $breadcrumbs[] = [
                    'title' => 'Услуги',
                ];
                break;

            case 'services.category':
                $breadcrumbs[] = [
                    'title' => 'Услуги',
                    'url' => route('services.index'),
                ];
                $breadcrumbs[] = [
                    'title' => $params['category']->title ?? 'Категория',
                ];
                break;

            case 'services.subcategory':
                $subcategory = $params['subcategory'];
                $category = $subcategory->category;

                $breadcrumbs[] = [
                    'title' => 'Услуги',
                    'url' => route('services.index'),
                ];

                if ($category) {
                    $breadcrumbs[] = [
                        'title' => $category->title,
                        'url' => route('services.category', $category->slug),
                    ];
                }

                $breadcrumbs[] = [
                    'title' => $subcategory->title,
                ];
                break;

            case 'services.show':
                $service = $params['service'];

                $breadcrumbs[] = [
                    'title' => 'Услуги',
                    'url' => route('services.index'),
                ];

                if ($service->category) {
                    $breadcrumbs[] = [
                        'title' => $service->category->title,
                        'url' => route('services.category', $service->category->slug),
                    ];
                }

                $breadcrumbs[] = [
                    'title' => $service->title,
                ];
                break;

            case 'projects.index':
                $breadcrumbs[] = [
                    'title' => 'Проекты',
                ];
                break;

            case 'projects.category':
                $breadcrumbs[] = [
                    'title' => 'Проекты',
                    'url' => route('projects.index'),
                ];
                $breadcrumbs[] = [
                    'title' => $params['category']->title ?? 'Категория',
                ];
                break;

            case 'projects.show':
                $project = $params['project'];
                $breadcrumbs[] = [
                    'title' => 'Проекты',
                    'url' => route('projects.index'),
                ];
                if ($project->category) {
                    $breadcrumbs[] = [
                        'title' => $project->category->title,
                        'url' => route('projects.category', $project->category->slug),
                    ];
                }
                $breadcrumbs[] = [
                    'title' => $project->title,
                ];
                break;

            case 'portfolio.index':
                $breadcrumbs[] = [
                    'title' => 'Портфолио',
                ];
                break;

            case 'portfolio.show':
                $item = $params['item'];
                $breadcrumbs[] = [
                    'title' => 'Портфолио',
                    'url' => route('portfolio.index'),
                ];
                if ($item->category) {
                    $breadcrumbs[] = [
                        'title' => $item->category->title,
                    ];
                }
                $breadcrumbs[] = [
                    'title' => $item->title,
                ];
                break;

            case 'page.show':
                $page = $params['page'];
                $breadcrumbs[] = [
                    'title' => $page->title,
                ];
                break;

            default:
                // fallback по имени роута
                $breadcrumbs[] = [
                    'title' => Str::title(str_replace('.', ' ', $routeName)),
                ];
        }

        return $breadcrumbs;
    }
}
