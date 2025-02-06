<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SymptomController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;

//Forgot Password
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

// Send Reset Link Email
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->middleware('guest')->name('password.email');

// Reset Password Form (with token)
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->middleware('guest')->name('password.reset');

// Update the Password
Route::post('/reset-password', [NewPasswordController::class, 'store'])->middleware('guest')->name('password.update');

// Landing Page
Route::get('/', function () {
    return view('landing.index');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.personal');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/password', [PasswordController::class, 'edit'])->name('profile.password');
});

// Appointment Routes
Route::middleware('auth')->group(function () {
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointment.list'); // View Appointments
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointment.create'); // Create Appointment Form
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointment.store'); // Store Appointment
    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointment.destroy'); // Delete Appointment
    Route::patch('/appointments/status', [AppointmentController::class, 'updateStatus'])->name('appointment.updateStatus'); // Update Appointment Status
});

// Patient Routes
Route::middleware('auth')->group(function () {
    Route::get('/patients/list', [PatientController::class, 'index'])->name('patient.list'); // View Patient List
    Route::get('/patient/symptom-checker', [SymptomController::class, 'index'])->name('symptom.checker'); // View Patient List
});

// Admin Routes
Route::middleware('auth')->group(function () {
    //Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard'); // Admin Dashboard
    Route::get('/admin/doctors/create', [AdminController::class, 'createDoctor'])->name('doctors.create'); // Add Doctor Form
    Route::post('/admin/doctors/store', [AdminController::class, 'storeDoctor'])->name('doctors.store'); // Store Doctor
    Route::get('/admin/doctors/list', [AdminController::class, 'listDoctors'])->name('doctors.list');// Doctor list
    Route::delete('/admin/doctors/{doctor}', [AdminController::class, 'destroyDoctor'])->name('doctors.destroy'); // Delete Doctor
    Route::delete('/patients/{id}', [PatientController::class, 'destroy'])->name('patients.destroy');
});



require __DIR__.'/auth.php';
