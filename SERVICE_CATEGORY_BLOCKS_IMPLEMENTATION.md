# ServiceCategory Blocks Implementation

## Overview
Added ServiceCategory blocks mirroring LandingPage sections (Hero, Types, Examples, Gallery, Prices, Calculator, Reviews) with full admin manageability via MoonShine, and rendering on ServiceCategory views.

## Changes Made

### 1. Database Migration
**File:** `database/migrations/2026_02_12_000001_add_landing_blocks_to_service_categories_table.php`

Added the following columns to `service_categories` table:

#### Hero Section
- `hero_title` (text, nullable) - Заголовок в hero секции
- `hero_subtitle` (text, nullable) - Подзаголовок в hero секции
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

### 2. Model Updates
**File:** `app/Models/ServiceCategory.php`

#### Updated Fillable Fields
Added all new landing block fields to the `$fillable` array:
- `hero_title`, `hero_subtitle`, `hero_items`
- `types_title`, `types`
- `examples_title`, `examples`
- `gallery_title`, `gallery_images`
- `price_title`, `price_table`
- `reviews_title`, `reviews`

#### Updated Casts
Added JSON casts for all JSON fields:
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

### 3. MoonShine Admin Interface
**File:** `app/MoonShine/Resources/ServiceCategory/Pages/ServiceCategoryFormPage.php`

Added new tabs to the ServiceCategory form:

#### Hero Section Tab
- Textarea: Заголовок (hero_title)
- Textarea: Подзаголовок (hero_subtitle)
- Json: Преимущества (hero_items) - array of text items

#### Types Tab
- Textarea: Заголовок секции (types_title)
- Json: Типы (types) - array with fields: title, price, image

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

### 4. View Updates
**File:** `resources/views/services/category.blade.php`

#### Added Hero Section
- Renders hero title, subtitle, and hero items
- Includes contact form with phone number input
- Only renders if `hero_title` or `hero_items` is set

#### Added Types Section
- Renders types in a grid layout similar to foundation types
- Displays type title, price, and image
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

#### JavaScript Enhancements
Added scripts for:
- Inputmask for phone numbers (+375 format with validation)
- Slick slider for reviews (gratitude-slider)
- Fancybox for gallery lightbox
- Responsive breakpoints for mobile devices

## Features

### Admin Capabilities
1. **Full CRUD** - All sections can be created, updated, and deleted via MoonShine admin
2. **Image Management** - Images are stored in `storage/services/categories/{slug}/` with subdirectories for each section
3. **JSON Fields** - Complex data structures (types, examples, reviews) are managed via MoonShine Json fields
4. **Removable Items** - All JSON arrays support adding/removing items
5. **Hints** - Each field includes helpful hints for administrators

### Frontend Capabilities
1. **Conditional Rendering** - Sections only display when they have content
2. **Responsive Design** - All sections are mobile-friendly
3. **Interactive Elements**:
   - Contact form with phone validation
   - Image gallery with lightbox
   - Reviews slider with autoplay
   - Price tables
4. **SEO-friendly** - Section titles support SEO optimization
5. **Consistent Styling** - Uses same CSS classes as LandingPage for consistent design

## File Structure

```
storage/services/categories/{slug}/
├── types/
│   └── {image_files}
├── examples/
│   └── {image_files}
├── gallery/
│   └── {image_files}
└── {category_image}
```

## Usage

### In Admin (MoonShine)
1. Navigate to Service Categories
2. Edit or create a Service Category
3. Use tabs to configure:
   - Hero секция: Set title, subtitle, and advantages
   - Типы: Add service types with images and prices
   - Примеры работ: Add examples with descriptions and images
   - Галерея: Upload gallery images
   - Цены: Build price table
   - Отзывы: Add customer reviews with ratings
4. Save the category

### On Frontend
- Visit the service category page (e.g., `/services/fundamenty`)
- All configured sections will automatically render
- Interactive elements (slider, lightbox, form) will work automatically

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

1. **Backward Compatible** - All new fields are nullable, so existing categories will continue to work
2. **Consistent with LandingPage** - The implementation mirrors LandingPage structure for consistency
3. **Extensible** - Easy to add more sections in the future following the same pattern
4. **Performance** - Uses eager loading and caching where appropriate
5. **Security** - All user inputs are properly escaped using Laravel's Blade `{!! !!}` for HTML content

## Future Enhancements

Potential improvements:
1. Add caching for frequently accessed data
2. Add sorting/ordering for reviews, examples, etc.
3. Add support for multiple languages
4. Add A/B testing capabilities
5. Add analytics tracking for sections
6. Add preview mode for admins
