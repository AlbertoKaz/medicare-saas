<?php

use App\Livewire\Patients\Create;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware([
    'auth',
    'verified',
    'current.clinic',
    ])->group(function () {

    Route::view('dashboard', 'dashboard')
        ->name('dashboard');

    Route::get('/patients/create', Create::class)
        ->name('patients.create');
});

require __DIR__.'/settings.php';
