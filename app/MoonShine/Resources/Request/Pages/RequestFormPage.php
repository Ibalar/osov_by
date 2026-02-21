<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Request\Pages;

use MoonShine\Laravel\Pages\EditPage;

/**
 * @extends EditPage<\App\Models\Request>
 */
class RequestFormPage extends EditPage
{
    protected string $title = 'Редактирование заявки';
}
