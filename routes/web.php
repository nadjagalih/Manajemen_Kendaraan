<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Models\Vehicle;

Route::get('/', function () {
    return view('landing');
})->name('landing');
// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');
Route::get('/admin/chart/vehicle-usage', function () {
    $vehicles = Vehicle::withCount('bookings')->get();

    return response()->json([
        'labels' => $vehicles->pluck('name'),
        'counts' => $vehicles->pluck('bookings_count'),
    ]);
})->name('chart.vehicle-usage');