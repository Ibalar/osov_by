<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteSetting::firstOrCreate(
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
}
