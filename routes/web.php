<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    if (request()->header('X-Requested-With') == 'XMLHttpRequest') {
        return view('partials.home');
    }
    return view('home.index');
});

Route::get('/services', function () {
    if (request()->header('X-Requested-With') == 'XMLHttpRequest') {
        return view('partials.services');
    }
    return view('services.index');
});

Route::get('/about', function () {
    if (request()->header('X-Requested-With') == 'XMLHttpRequest') {
        return view('partials.about');
    }
    return view('about.index');
});

Route::get('/contact', function () {
    if (request()->header('X-Requested-With') == 'XMLHttpRequest') {
        return view('partials.contact');
    }
    return view('contact.index');
});
