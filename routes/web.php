<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', fn() => 'Admin Dashboard');
});

// Business Owner routes
Route::middleware(['auth', 'role:business_owner'])->group(function () {
    Route::get('/owner/dashboard', fn() => 'Business Owner Dashboard');
});

// Customer routes
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/customer/dashboard', fn() => 'Customer Dashboard');
});
