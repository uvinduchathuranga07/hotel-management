<?php
use App\Http\Controllers\RoomController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Hotel routes
Route::middleware('auth')->group(function () {
    Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
    Route::get('/hotels/{id}/edit', [HotelController::class, 'edit'])->name('hotels.edit');
    Route::get('/hotels/create', [HotelController::class, 'create'])->name('hotels.create'); // Show create form
    Route::post('/hotels', [HotelController::class, 'store'])->name('hotels.store'); // Store a new hotel
    Route::get('/hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.show'); // Display a specific hotel
    Route::patch('/hotels/{hotel}', [HotelController::class, 'update'])->name('hotels.update'); // Update a hotel
    Route::delete('/hotels/{hotel}', [HotelController::class, 'destroy'])->name('hotels.destroy'); // Delete a hotel
});

Route::middleware('auth')->group(function () {
    // Display a list of all rooms
    Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');

    // Show the form to create a new room
    Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');

    // Store a new room
    Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');

    // Display a specific room
    Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');

    // Show the form to edit an existing room
    Route::get('/rooms/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit');

    // Update the specified room
    Route::patch('/rooms/{room}', [RoomController::class, 'update'])->name('rooms.update');

    // Delete a room
    Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');
});

require __DIR__.'/auth.php';
