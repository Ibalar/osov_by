<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'phone',
        'email',
        'address',
        'social_links',
        'logo_path',
        'logo_dark_path',
        'logo_footer_path',
    ];

    protected $casts = [
        'social_links' => 'array',
    ];

    private static ?self $instance = null;

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = self::firstOrCreate(
                ['id' => 1],
                [
                    'phone' => '+375 (33) 319-64-51',
                    'email' => 'info@osov.by',
                    'address' => 'г. Минск, ул. Примерная, 123',
                    'social_links' => [
                        'facebook' => '#',
                        'instagram' => '#',
                        'linkedin' => '#',
                        'youtube' => '#',
                    ],
                    'logo_path' => 'images/logo.png',
                    'logo_dark_path' => 'images/logo-dark.png',
                    'logo_footer_path' => 'images/logo.svg',
                ]
            );
        }

        return self::$instance;
    }
}
