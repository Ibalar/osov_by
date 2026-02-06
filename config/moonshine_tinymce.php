<?php

return [
    'token' => env('TINYMCE_TOKEN', ''),
    'plugins' => [
        'anchor', 'autolink', 'autoresize', 'charmap', 'codesample', 'code', 'emoticons', 'image', 'link',
        'lists', 'advlist', 'media', 'searchreplace', 'table', 'wordcount', 'directionality',
        'fullscreen', 'help', 'nonbreaking', 'pagebreak', 'preview', 'visualblocks', 'visualchars'
    ],
    'menubar' => 'file edit insert view format table tools',
    'toolbar' => 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | '
        . 'link image media table tabledelete hr nonbreaking pagebreak | align lineheight | '
        . 'numlist bullist indent outdent | emoticons charmap | removeformat | codesample | ltr rtl | '
        . 'tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | '
        . 'tableinsertcolbefore tableinsertcolafter tabledeletecol | '
        . 'fullscreen preview print visualblocks visualchars code | help',

    'options' => [
        'file_manager' => 'laravel-filemanager',
        // Разрешить любые теги и атрибуты, чтобы не обрезались классы и data-атрибуты
        'valid_elements' => '*[*]',
        'extended_valid_elements' => 'div[class|id|data-wow-delay],p[class|data-wow-delay],h2[class|data-wow-delay],ul,li',

        // Добавляем форматы для быстрого добавления кастомных блоков
        'style_formats' => [
            ['title' => 'Amenity Entry', 'block' => 'div', 'classes' => 'amenity-entry'],
            ['title' => 'Amenity Feature Box', 'block' => 'div', 'classes' => 'amenity-feature-box'],
            ['title' => 'Amenity Benefits Box', 'block' => 'div', 'classes' => 'amenity-benefits-box'],
            ['title' => 'Amenity Benefits List', 'block' => 'div', 'classes' => 'amenity-benefits-list'],
            ['title' => 'WOW Paragraph', 'block' => 'p', 'classes' => 'wow fadeInUp'],
            ['title' => 'Delayed WOW Paragraph', 'block' => 'p', 'classes' => 'wow fadeInUp', 'attributes' => ['data-wow-delay' => '0.2s']],
            ['title' => 'Heading Style 3', 'block' => 'h2', 'classes' => 'text-anime-style-3'],
        ],

        // Разрешаем вложенность элементов, чтобы не удалялись блоки внутри body
        'valid_children' => '+body[style|div|p|ul|li|h2]',
    ],

    'callbacks' => [],
];

