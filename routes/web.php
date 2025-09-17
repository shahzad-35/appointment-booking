<?php

use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Industries;
use App\Livewire\Customer\Dashboard as CustomerDashboard;
use App\Livewire\Owner\Dashboard as OwnerDashboard;
use App\Livewire\Owner\Services;
use App\Livewire\Owner\Slots;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware('auth')->group(function () {
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('dashboard', AdminDashboard::class)->name('admin.dashboard');
        Route::get('industries', Industries::class)->name('admin.industries');
    });
    // Business Owner routes
    Route::middleware('role:business_owner')->prefix('owner')->group(function () {
        Route::get('dashboard', OwnerDashboard::class)->name('owner.dashboard');
        Route::get('services', Services::class)->name('owner.services');
        Route::get('services/{serviceId}/slots', Slots::class)->name('owner.slots');
    });
    // Customer routes
    Route::middleware('role:customer')->group(function () {
        Route::get('/customer/dashboard', CustomerDashboard::class)->name('customer.dashboard');
    });
});

