<?php

use App\Http\Controllers\RedirectController;
use App\Livewire\Admin\BookingsList as AdminBookingsList;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Industries;
use App\Livewire\Customer\BookingHistory;
use App\Livewire\Customer\BookingsList as CustomerBookingsList;
use App\Livewire\Customer\CreateBooking;
use App\Livewire\Customer\Dashboard as CustomerDashboard;
use App\Livewire\Owner\BookingsList as OwnerBookingsList;
use App\Livewire\Owner\Dashboard as OwnerDashboard;
use App\Livewire\Owner\Services;
use App\Livewire\Owner\Slots;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/redirect-dashboard', RedirectController::class)
    ->middleware('auth')
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware('auth')->group(function () {
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('dashboard', AdminDashboard::class)->name('admin.dashboard');
        Route::get('industries', Industries::class)->name('admin.industries');
        Route::get('bookings', AdminBookingsList::class)->name('admin.bookings');

    });
    // Business Owner routes
    Route::middleware('role:business_owner')->prefix('owner')->group(function () {
        Route::get('dashboard', OwnerDashboard::class)->name('owner.dashboard');
        Route::get('services', Services::class)->name('owner.services');
        Route::get('services/{serviceId}/slots', Slots::class)->name('owner.slots');
        Route::get('bookings', OwnerBookingsList::class)->name('owner.bookings');

    });
    // Customer routes
    Route::middleware('role:customer')->prefix('customer')->group(function () {
        Route::get('dashboard', CustomerDashboard::class)->name('customer.dashboard');
        Route::get('create-booking', CreateBooking::class)->name('customer.booking');
        Route::get('bookings', CustomerBookingsList::class)->name('customer.bookings');
        Route::get('bookings-history', BookingHistory::class)->name('customer.bookings_history');

    });
});

