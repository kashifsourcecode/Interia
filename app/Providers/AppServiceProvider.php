<?php

namespace App\Providers;

use App\Models\AboutSection;
use App\Models\AiAdoptionSection;
use App\Models\ContactSection;
use App\Models\GallerySection;
use App\Models\IndustrySection;
use App\Models\OfferSection;
use App\Models\PricingSection;
use App\Models\ServiceSection;
use App\Models\WhySection;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::addNamespace('website', resource_path('website'));

        RateLimiter::for('contact', fn (Request $request): Limit => Limit::perMinute(5)->by($request->ip()));

        RateLimiter::for('enterprise-quote', fn (Request $request): Limit => Limit::perMinute(3)->by($request->ip()));

        View::composer('website::layouts.app', function ($view): void {
            $view->with('homeSectionNav', [
                'services' => ServiceSection::query()
                    ->where('slug', 'home')
                    ->where('is_active', true)
                    ->exists(),
                'industries' => IndustrySection::query()
                    ->where('slug', 'home')
                    ->where('is_active', true)
                    ->exists(),
                'why' => WhySection::query()
                    ->where('slug', 'home')
                    ->where('is_active', true)
                    ->exists(),
                'gallery' => GallerySection::query()
                    ->where('slug', 'home')
                    ->where('is_active', true)
                    ->exists(),
                'offers' => OfferSection::query()
                    ->where('slug', 'home')
                    ->where('is_active', true)
                    ->exists(),
                'about' => AboutSection::query()
                    ->where('slug', 'home')
                    ->where('is_active', true)
                    ->exists(),
                'contact' => ContactSection::query()
                    ->where('slug', 'home')
                    ->where('is_active', true)
                    ->exists(),
            ]);
        });

        View::composer('website::sections.services', function ($view): void {
            $view->with(
                'serviceSection',
                ServiceSection::query()
                    ->where('slug', 'home')
                    ->where('is_active', true)
                    ->with(['carouselItems', 'cards'])
                    ->first(),
            );
        });

        View::composer('website::sections.gallery', function ($view): void {
            $view->with(
                'gallerySection',
                GallerySection::query()
                    ->where('slug', 'home')
                    ->where('is_active', true)
                    ->with('items')
                    ->first(),
            );
        });

        View::composer('website::sections.ai', function ($view): void {
            $view->with(
                'aiAdoptionSection',
                AiAdoptionSection::query()
                    ->where('slug', 'home')
                    ->where('is_active', true)
                    ->with(['steps', 'checklistItems'])
                    ->first(),
            );
        });

        View::composer('website::sections.why', function ($view): void {
            $view->with(
                'whySection',
                WhySection::query()
                    ->where('slug', 'home')
                    ->where('is_active', true)
                    ->with('features')
                    ->first(),
            );
        });

        View::composer('website::sections.offers', function ($view): void {
            $view->with(
                'offerSection',
                OfferSection::query()
                    ->where('slug', 'home')
                    ->where('is_active', true)
                    ->with('cards')
                    ->first(),
            );
        });

        View::composer('website::sections.pricing', function ($view): void {
            $view->with(
                'pricingSection',
                PricingSection::query()
                    ->where('slug', 'home')
                    ->where('is_active', true)
                    ->with(['plans', 'addonCards'])
                    ->first(),
            );
        });

        View::composer('website::sections.about', function ($view): void {
            $view->with(
                'aboutSection',
                AboutSection::query()
                    ->where('slug', 'home')
                    ->where('is_active', true)
                    ->first(),
            );
        });

        View::composer('website::sections.industries', function ($view): void {
            $view->with(
                'industrySection',
                IndustrySection::query()
                    ->where('slug', 'home')
                    ->where('is_active', true)
                    ->with('cards')
                    ->first(),
            );
        });

        View::composer('website::sections.contact', function ($view): void {
            $view->with(
                'contactSection',
                ContactSection::query()
                    ->where('slug', 'home')
                    ->where('is_active', true)
                    ->with('infoCards')
                    ->first(),
            );
        });
    }
}
