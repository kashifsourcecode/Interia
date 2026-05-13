<?php

use App\Http\Controllers\ContactSubmissionController;
use App\Http\Controllers\EnterpriseQuoteController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'website::home')->name('home');

$websiteScrollSections = [
    'services',
    'industries',
    'why',
    'gallery',
    'offers',
    'pricing',
    'about',
    'contact',
];

foreach ($websiteScrollSections as $slug) {
    Route::get('/'.$slug, function () use ($slug) {
        return view('website::home', ['scrollTo' => $slug]);
    })->name('website.section.'.$slug);
}

Route::post('/contact', [ContactSubmissionController::class, 'store'])
    ->middleware('throttle:contact')
    ->name('contact.store');

Route::post('/enterprise-quote', [EnterpriseQuoteController::class, 'store'])
    ->middleware('throttle:enterprise-quote')
    ->name('enterprise-quote.store');
