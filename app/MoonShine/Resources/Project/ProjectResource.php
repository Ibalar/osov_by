<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Project;

use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use App\MoonShine\Resources\Project\Pages\ProjectIndexPage;
use App\MoonShine\Resources\Project\Pages\ProjectFormPage;
use App\MoonShine\Resources\Project\Pages\ProjectDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;

/**
 * @extends ModelResource<Project, ProjectIndexPage, ProjectFormPage, ProjectDetailPage>
 */
class ProjectResource extends ModelResource
{
    protected string $model = Project::class;

    protected string $title = 'Проекты';

    protected string $column = 'title';

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            ProjectIndexPage::class,
            ProjectFormPage::class,
            ProjectDetailPage::class,
        ];
    }

    protected function rules(mixed $item): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],

            'seo.title' => ['nullable', 'string', 'max:255'],
            'seo.h1' => ['nullable', 'string', 'max:255'],
            'seo.description' => ['nullable', 'string'],
            'seo.keywords' => ['nullable', 'string'],
        ];
    }
}
