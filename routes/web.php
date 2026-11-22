<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

if (app()->environment('local')) {
    Route::get('/preview/admin/dashboard', [DashboardController::class, 'index'])
        ->name('preview.admin.dashboard');
}
