<?php

use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('register-patient', function () {
    return Inertia::render('PatientRegister');
})->name('patients.create');

Route::post('register-patient', [PatientController::class, 'store'])
    ->name('patients.store');

Route::get('thankyou', function () {
    return Inertia::render('ThankYou');
})->name('thankyou');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/patients', [PatientController::class, 'index'])->name('patients.index');
    Route::delete('admin/patients/{id}', [PatientController::class, 'destroy'])->name('patients.delete');
});

require __DIR__ . '/settings.php';
