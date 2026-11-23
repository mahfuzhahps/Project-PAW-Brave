<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;

Route::get('/', function () {
    return view('welcome');
});

if (app()->environment('local')) {
    Route::get('/preview/admin/dashboard', [DashboardController::class, 'index'])
        ->name('preview.admin.dashboard');

    Route::get('/preview/admin/events', [AdminEventController::class, 'index'])
        ->name('preview.admin.events.index');
}
