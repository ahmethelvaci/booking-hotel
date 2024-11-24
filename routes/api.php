<?php

use App\Http\Controllers\HotelController;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function (){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/test', function (Request $request) {
        return Hotel::paginate();
    });

    Route::get('hotels',[HotelController::class, 'index'])->name('hotels.index');
});
