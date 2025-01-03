<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\HotelController;
use App\Http\Controllers\API\RoomController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------

|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API routes for Hotels
Route::apiResource('hotels', HotelController::class);

// API routes for Rooms
Route::apiResource('rooms', RoomController::class);
