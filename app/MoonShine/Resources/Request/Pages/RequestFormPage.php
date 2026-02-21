<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Request\Pages;
use MoonShine\Laravel\Pages\Crud\FormPage;
/**
 * @extends FormPage<\App\MoonShine\Resources\Request\RequestResource>
 */
class RequestFormPage extends FormPage
{
    protected string $title = 'Редактирование заявки';
}
