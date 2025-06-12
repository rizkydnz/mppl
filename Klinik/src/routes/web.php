<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Illuminate\View\View;

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
Route::get('/admin/dokter', function () {
    // Data dummy sementara
    $dokters = [
        (object)[
            'id' => 1,
            'nama_dokter' => 'Dr. Andi',
            'spesialisasi_dokter' => 'Spesialis Anak',
            'alamat_dokter' => 'Jl. Melati No.10'
        ],
        (object)[
            'id' => 2,
            'nama_dokter' => 'Dr. Budi',
            'spesialisasi_dokter' => 'Spesialis Bedah',
            'alamat_dokter' => 'Jl. Mawar No.20'
        ]
    ];

    return view('admin.dokter.index', compact('dokters'));
});