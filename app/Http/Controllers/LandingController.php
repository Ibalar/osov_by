<?php

namespace App\Http\Controllers;

use App\Models\LandingPage;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Отобразить лендинг
     */
    public function show($slug)
    {
        $landingPage = LandingPage::query()
            ->where('slug', $slug)
            ->active()
            ->firstOrFail();

        return view('landings.show', [
            'landingPage' => $landingPage,
            
            // SEO
            'seoTitle' => $landingPage->seo_title,
            'metaDescription' => $landingPage->meta_description,
        ]);
    }
}
