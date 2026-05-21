<?php

use App\Livewire\Patients\Create;
use App\Livewire\Patients\Show as ShowPatient;
use App\Livewire\Appointments\Create as CreateAppointment;
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

    Route::get('/patients/{patient}/appointments/create', CreateAppointment::class)
        ->name('patients.appointments.create');

    Route::get('/patients/{patient}', ShowPatient::class)
        ->name('patients.show');
});

require __DIR__.'/settings.php';
