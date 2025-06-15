<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use App\Http\Controllers\AppointmentController;

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
Route::view('/appointment', 'frontend.appointment')->name('appointment');
Route::view('/team', 'frontend.team')->name('team');
Route::view('/testimonial', 'frontend.testimonial')->name('testimonial');
Route::view('/contact', 'frontend.contact')->name('contact');
Route::view('/404', 'frontend.404')->name('404');

// Untuk menyimpan appointment dari form
Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointment.store');

// (Opsional) Detail per appointment
Route::get('/admin/appointments/{id}', [AppointmentController::class, 'show'])->name('admin.appointments.show');