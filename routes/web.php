<?php

use App\Livewire\HomePage;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

Route::get('/', HomePage::class)->name('home');

Livewire::setScriptRoute(function ($handle) {
    $vendorUrl = asset('vendor');
    return Route::get("{$vendorUrl}/livewire/livewire.js", $handle);
});
