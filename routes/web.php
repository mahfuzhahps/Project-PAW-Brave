<?php

use Illuminate\Support\Facades\Route;

Route::get('/event-tersimpan', function () {
    return view('saved-events');
})->name('saved-events');
