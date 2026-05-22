<?php

use App\Livewire\Dashboard\Index as DashboardIndex;
use App\Livewire\ClinicalNotes\Create as CreateClinicalNote;
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

    /*Route::view('dashboard', 'dashboard')
        ->name('dashboard');*/

    Route::get('/dashboard', DashboardIndex::class)
        ->name('dashboard');

    Route::get('/patients/create', Create::class)
        ->name('patients.create');

    Route::get('/patients/{patient}/appointments/create', CreateAppointment::class)
        ->name('patients.appointments.create');

    Route::get('/patients/{patient}', ShowPatient::class)
        ->name('patients.show');

    Route::get('/patients/{patient}/clinical-notes/create', CreateClinicalNote::class)
        ->name('patients.clinical-notes.create');
});

require __DIR__.'/settings.php';
