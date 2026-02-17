# Service Blocks Implementation

## Overview
Added Service blocks mirroring ServiceCategory sections (Hero, Types, Examples, Gallery, Prices, Calculator, Reviews) with full admin manageability via MoonShine, and rendering on Service views.

## Changes Made

### 1. Database Migration
**File:** `database/migrations/2026_02_18_000001_add_landing_blocks_to_services_table.php`

Added the following columns to `services` table:

#### Hero Section
- `hero_title` (text, nullable) - Заголовок в hero секции
- `hero_subtitle` (text, nullable) - Подзаголовок в hero секции
- `hero_bg_image` (string, nullable) - Фоновое изображение hero секции
- `hero_items` (json, nullable) - Преимущества в hero секции

#### Types Section
- `types_title` (text, nullable) - Заголовок секции типов
- `types` (json, nullable) - Массив типов (название, цена, изображение)

#### Examples Section
- `examples_title` (text, nullable) - Заголовок секции выполненных работ
- `examples` (json, nullable) - Выполненные работы

#### Gallery Section
- `gallery_title` (text, nullable) - Заголовок галереи
- `gallery_images` (json, nullable) - Изображения галереи

#### Price Table Section
- `price_title` (text, nullable) - Заголовок таблицы цен
- `price_table` (json, nullable) - Таблица цен

#### Reviews Section
- `reviews_title` (text, nullable) - Заголовок отзывов
- `reviews` (json, nullable) - Отзывы (слайдер)

#### Calculator Section
- `calculator_enabled` (boolean, default: false) - Включен ли калькулятор
- `calculator_title` (string, nullable) - Заголовок калькулятора
- `calculator_description` (text, nullable) - Описание калькулятора
- `calculator_formula` (text, nullable) - Формула расчета
- `calculator_currency` (string, default: 'BYN') - Валюта
- `calculator_result_label` (string, default: 'Итоговая стоимость') - Подпись результата
- `calculator_fields` (json, nullable) - Поля калькулятора (key, label, type, default_value, options, min, max, step)

### 2. Model Updates
**File:** `app/Models/Service.php`

#### Updated Fillable Fields
Added all new landing block fields to the `$fillable` array:
- Hero: `hero_title`, `hero_subtitle`, `hero_bg_image`, `hero_items`
- Types: `types_title`, `types`
- Examples: `examples_title`, `examples`
- Gallery: `gallery_title`, `gallery_images`
- Prices: `price_title`, `price_table`
- Reviews: `reviews_title`, `reviews`
- Calculator: `calculator_enabled`, `calculator_title`, `calculator_description`, `calculator_formula`, `calculator_currency`, `calculator_result_label`, `calculator_fields`

#### Updated Casts
Added JSON casts for all JSON fields:
- `calculator_enabled` => 'boolean'
- `calculator_fields` => 'array'
- `hero_items` => 'array'
- `types` => 'array'
- `examples` => 'array'
- `gallery_images` => 'array'
- `price_table` => 'array'
- `reviews' => 'array'

#### Added Accessors
- `getGalleryImagesUrlsAttribute()` - Returns array of full URLs for gallery images
- `getTypesImagesUrlsAttribute()` - Returns array of types with image URLs
- `getExamplesImagesUrlsAttribute()` - Returns array of examples with image URLs
- `getHeroBgImageUrlAttribute()` - Returns full URL for hero background image
- `getHeroItemsWithIconsAttribute()` - Returns array of hero items with icon URLs

### 3. MoonShine Admin Interface
**File:** `app/MoonShine/Resources/Service/Pages/ServiceFormPage.php`

Added new tabs to the Service form:

#### Hero Section Tab
- Textarea: Заголовок (hero_title)
- Textarea: Подзаголовок (hero_subtitle)
- Image: Фоновое изображение (hero_bg_image) - background image for header-body__img
- Json: Преимущества (hero_items) - array with fields: text, icon (optional, uses CSS ::after if not set)

#### Types Tab
- Textarea: Заголовок секции (types_title)
- Json: Типы (types) - array with fields: title, price, unit, image

#### Examples Tab
- Textarea: Заголовок (examples_title)
- Json: Примеры (examples) - array with fields: title, description, image

#### Gallery Tab
- Textarea: Заголовок (gallery_title)
- Json: Изображения (gallery_images) - array of images

#### Prices Tab
- Textarea: Заголовок (price_title)
- Json: Таблица цен (price_table) - array with fields: Наименование, Цена, Ед. изм.

#### Reviews Tab
- Textarea: Заголовок (reviews_title)
- Json: Отзывы (reviews) - array with fields: name, text, date, rating

#### Calculator Tab
- Switcher: Включить калькулятор (calculator_enabled)
- Text: Заголовок калькулятора (calculator_title)
- Textarea: Описание калькулятора (calculator_description)
- Text: Подпись результата (calculator_result_label)
- Text: Валюта (calculator_currency)
- Textarea: Формула расчета (calculator_formula)
- Json: Поля калькулятора (calculator_fields) - array with fields: key, label, type, default_value, placeholder, min, max, step, options

### 4. View Updates
**File:** `resources/views/services/show.blade.php`

#### Added Hero Section
- Renders hero title, subtitle, and hero items
- Supports configurable background image for `header-body__img` block via `hero_bg_image` field
- Hero items support custom icons via `icon` field; if not set, uses default CSS ::after pseudo-elements
- Includes contact form with phone number input
- Only renders if `hero_title` or `hero_items` is set

#### Added Types Section
- Renders types in a grid layout similar to foundation types
- Displays type title, price, unit, and image
- Only renders if `types` is not empty

#### Added Examples Section
- Renders examples in a grid layout
- Displays example title, description, and image
- Only renders if `examples` is not empty

#### Added Gallery Section
- Renders gallery images with fancybox lightbox
- Only renders if `gallery_images` is not empty

#### Added Price Table Section
- Renders price table with headers and rows
- Dynamically builds table from `price_table` JSON
- Only renders if `price_table` is not empty

#### Added Reviews Section
- Renders reviews slider with slick slider
- Displays review name, text, date, and rating (stars)
- Only renders if `reviews` is not empty

#### Added Calculator Section
- Renders universal calculator with customizable fields
- Supports multiple field types: number, text, select, radio, checkbox, range
- Calculates results in real-time using custom formula
- Only renders if `calculator_enabled` is true and `calculator_fields` is not empty

#### JavaScript Enhancements
Added scripts for:
- Inputmask for phone numbers (+375 format with validation)
- Slick slider for reviews (gratitude-slider)
- Fancybox for gallery lightbox
- Universal calculator with real-time calculations
- Responsive breakpoints for mobile devices

## Features

### Admin Capabilities
1. **Full CRUD** - All sections can be created, updated, and deleted via MoonShine admin
2. **Image Management** - Images are stored in `storage/services/{slug}/` with subdirectories for each section
3. **JSON Fields** - Complex data structures (types, examples, reviews, calculator fields) are managed via MoonShine Json fields
4. **Removable Items** - All JSON arrays support adding/removing items
5. **Hints** - Each field includes helpful hints for administrators
6. **Calculator Configuration** - Fully configurable calculator with custom formulas and field types

### Frontend Capabilities
1. **Conditional Rendering** - Sections only display when they have content
2. **Responsive Design** - All sections are mobile-friendly
3. **Interactive Elements**:
   - Contact form with phone validation
   - Image gallery with lightbox
   - Reviews slider with autoplay
   - Price tables
   - Universal calculator with real-time calculations
4. **SEO-friendly** - Section titles support SEO optimization
5. **Consistent Styling** - Uses same CSS classes as ServiceCategory for consistent design

## File Structure

```
storage/services/{slug}/
├── hero/
│   └── {icon_files}
├── types/
│   └── {image_files}
├── examples/
│   └── {image_files}
├── gallery/
│   └── {image_files}
└── {hero_bg_image}
```

## Usage

### In Admin (MoonShine)
1. Navigate to Services
2. Edit or create a Service
3. Use tabs to configure:
   - Hero секция: Set title, subtitle, and advantages
   - Типы: Add service types with images and prices
   - Примеры работ: Add examples with descriptions and images
   - Галерея: Upload gallery images
   - Цены: Build price table
   - Отзывы: Add customer reviews with ratings
   - Калькулятор: Configure calculator with fields and formula
4. Save the service

### On Frontend
- Visit the service page (e.g., `/services/{slug}`)
- All configured sections will automatically render
- Interactive elements (slider, lightbox, form, calculator) will work automatically

## Migration

To apply the database changes:
```bash
php artisan migrate
```

To rollback:
```bash
php artisan migrate:rollback
```

## Notes

1. **Backward Compatible** - All new fields are nullable, so existing services will continue to work
2. **Consistent with ServiceCategory** - The implementation mirrors ServiceCategory structure for consistency
3. **Extensible** - Easy to add more sections in the future following the same pattern
4. **Performance** - Uses eager loading and caching where appropriate
5. **Security** - All user inputs are properly escaped using Laravel's Blade `{!! !!}` for HTML content
6. **Calculator Flexibility** - Supports custom formulas with field placeholders `{field_key}` for dynamic calculations

## Universal Calculator Details

The calculator is fully configurable through the admin interface:

### Field Types Supported:
- `number` - Numeric input with min/max/step
- `text` - Text input
- `select` - Dropdown with options
- `radio` - Radio button group with options
- `checkbox` - Checkbox field
- `range` - Range slider with visual feedback

### Formula Examples:
- `{width} * {length} * {price}`
- `{base_price} * {area} * {complexity} + {delivery}`
- `{price} * {quantity}`

### Features:
- Real-time calculation as user inputs change
- Reset functionality to default values
- Currency customization
- Result label customization
- Responsive design for mobile devices
- Input validation and sanitization

## Future Enhancements

Potential improvements:
1. Add caching for frequently accessed data
2. Add sorting/ordering for reviews, examples, etc.
3. Add support for multiple languages
4. Add A/B testing capabilities
5. Add analytics tracking for sections
6. Add preview mode for admins
7. Add calculator result export/print functionality
8. Add more calculator field types (date, color, etc.)
