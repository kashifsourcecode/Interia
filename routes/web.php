<?php

use App\Http\Controllers\ContactSubmissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('website::home');
});

Route::post('/contact', [ContactSubmissionController::class, 'store'])
    ->middleware('throttle:contact')
    ->name('contact.store');
