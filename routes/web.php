<?php

use App\Http\Controllers\RedirectController;
use App\Livewire\Admin\BookingManagement;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Industries;
use App\Livewire\Admin\OwnerOverview;
use App\Livewire\Admin\ServiceManagement;
use App\Livewire\Admin\UserManagement;
use App\Livewire\Customer\BookingsList as CustomerBookingsList;
use App\Livewire\Customer\CreateBooking;
use App\Livewire\Customer\Dashboard as CustomerDashboard;
use App\Livewire\Customer\RescheduleBooking;
use App\Livewire\Owner\BookingsList as OwnerBookingsList;
use App\Livewire\Owner\Dashboard as OwnerDashboard;
use App\Livewire\Owner\Services;
use App\Livewire\Owner\ManageServiceSlots;
use App\Livewire\Owner\SlotsListing;
use App\Livewire\ProfileUpdate;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/redirect-dashboard', RedirectController::class)
    ->middleware('auth')
    ->name('dashboard');

Route::get('/profile', ProfileUpdate::class)->name('profile');


Route::middleware('auth')->group(function () {
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('dashboard', AdminDashboard::class)->name('admin.dashboard');
        Route::get('industries', Industries::class)->name('admin.industries');
        Route::get('/users', UserManagement::class)->name('admin.users');
        Route::get('/services', ServiceManagement::class)->name('admin.services');
        Route::get('/bookings', BookingManagement::class)->name('admin.bookings');
        Route::get('/owners', OwnerOverview::class)->name('admin.owners');

    });
    // Business Owner routes
    Route::middleware('role:business_owner')->prefix('owner')->group(function () {
        Route::get('dashboard', OwnerDashboard::class)->name('owner.dashboard');
        Route::get('services', Services::class)->name('owner.services');
        Route::get('services/{serviceId}/slots', ManageServiceSlots::class)->name('owner.service.slots');
        Route::get('bookings', OwnerBookingsList::class)->name('owner.bookings');

        Route::get('/slots', SlotsListing::class)->name('owner.slots');

    });
    // Customer routes
    Route::middleware('role:customer')->prefix('customer')->group(function () {
        Route::get('dashboard', CustomerDashboard::class)->name('customer.dashboard');
        Route::get('create-booking', CreateBooking::class)->name('customer.create.booking');
        Route::get('bookings', CustomerBookingsList::class)->name('customer.bookings');
        Route::get('/bookings/{booking}/reschedule', RescheduleBooking::class)->name('bookings.reschedule');

    });
});

require __DIR__ . '/auth.php';
