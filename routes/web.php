<?php

use Illuminate\Support\Facades\Route;


Route::get('clear-cache', [App\Http\Controllers\ClearCacheController::class, 'clearCache'])->name('clearCache');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
