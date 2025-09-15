<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortlinkController;

Route::post('/shortlinks', [ShortlinkController::class, 'store']);
Route::get('/shortlinks', [ShortlinkController::class, 'index']);
