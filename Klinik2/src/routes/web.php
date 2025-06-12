<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

/* NOTE: Do Not Remove
/ Livewire asset handling if using sub folder in domain
*/
Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});
/*
/ END
*/
// Route::get('/', function () {
//     return view('welcome');
// });
// Routing halaman utama frontend (pakai folder frontend)
Route::view('/', 'frontend.index')->name('home');
Route::view('/about', 'frontend.about')->name('about');
Route::view('/causes', 'frontend.causes')->name('causes');
Route::view('/service', 'frontend.service')->name('service');
Route::view('/donate', 'frontend.donate')->name('donate');
Route::view('/team', 'frontend.team')->name('team');
Route::view('/testimonial', 'frontend.testimonial')->name('testimonial');
Route::view('/contact', 'frontend.contact')->name('contact');
Route::view('/404', 'frontend.404')->name('404');